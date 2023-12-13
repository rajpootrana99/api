<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Message;
use App\Models\Task;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use stdClass;


class MessageController extends Controller
{
    public function index()
    {
        return view('message.index');
    }

    public function fetchPeoples()
    {
        $users = Message::with('sender')->whereNotIn('sender_id', [Auth::id()])->get()->unique('sender_id');
        return response()->json([
            'status' => 1,
            'users' => $users,
        ]);
    }


    public function getTaskItems($task)
    {
        return view('Chatify::layouts.listItem'
        , [
            "get" => "tasks",
            "task" => ($task),
            "entity" => $task->entity
            ])->render();
    }

    protected $perPage = 30;

    public function getTasks(Request $request)
    {

        // get all users that received/sent message from/to [Auth user]
        // $users = Message::join('users', function ($join) {
        //     $join->on('ch_messages.from_id', '=', 'users.id')
        //         ->orOn('ch_messages.to_id', '=', 'users.id');
        // })
        //     ->where(function ($q) {
        //         $q->where('ch_messages.from_id', Auth::user()->id)
        //             ->orWhere('ch_messages.to_id', Auth::user()->id);
        //     })
        //     ->where('users.id', '!=', Auth::user()->id)
        //     ->select('users.*', DB::raw('MAX(ch_messages.created_at) as max_created_at'))
        //     ->orderBy('max_created_at', 'desc')
        //     ->groupBy(
        //         'users.id',
        //         'users.entity_id'
        //     )
        //     ->paginate($request->per_page ?? $this->perPage);


        // $tasks = Task::all()->where("status","!=","Cancelled")->all();

        $tasks = Task::where("title","LIKE","%".$request->input("search","")."%")
        ->with(['entity', 'site'])
        ->orderByDesc("updated_at")
        ->get()
        ->where("status","!=","Cancelled");
        // return response()->json([
        //     "tasks"=>$tasks,
        //     // "query" =>
        //     // "entity" => Entity::all()->where("id","==",$tasks[0]["entity_id"])->first()->toArray()
        // ], 200);

        $taskList = "";
        if (count($tasks) > 0) {
            foreach ($tasks as $task) {
                $taskList .= $this->getTaskItems($task);
            }
        } else {
            $taskList = '<p class="message-hint center-el"><span>No Tasks Found</span></p>';
        }


        return Response::json([
            'tasks' => $taskList,
            'total' => count($tasks) ?? 0,
            // 'last_page' => $users->lastPage() ?? 1,
        ], 200);
    }

    public function fetchMessages($sender)
    {
        $messages = Message::with('sender', 'receiver', 'task')->where('sender_id', $sender)
            ->orWhere('receiver_id', $sender)
            ->get();
        $sender = User::where('id', $sender)->first();
        if (count($messages) > 0) {
            return response()->json([
                'status' => true,
                'messages' => $messages,
                'sender' => $sender,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No message yet',
            ]);
        }
    }

    public function fetchTaskMessages($task)
    {
        $messages = Message::with('sender', 'receiver', 'task')->where('task_id', $task)
            ->get();
        if (count($messages) > 0) {
            return response()->json([
                'status' => true,
                'messages' => $messages,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No message yet',
            ]);
        }
    }

    public function sendMessage(Request $request)
    {
        try {
            $task = Task::with('user')->find($request->task_id);
            $response = '';

            $SERVER_API_KEY = 'AAAAFwVn-58:APA91bEkI_A6lAZMm1Jx1rBv8drv8pMRyCnWKzuVKc4LA8W0wzTgXNf0FCevcSkIegRwM2y4T0h68_jMnP66uOjZNY8B2DL5k03-POUfDXJzcYgnHwSFQB6cq2NEZXo1nqZTygd8GJbX';

            $token = Token::where('user_id', $task->user_id)->first();

            $token_1 = $token->token;

            $data = [

                "registration_ids" => [
                    $token_1
                ],

                "notification" => [

                    "title" => "Notification",

                    "body" => "You have recieved new message",

                    "sound" => "default" // required for sound on ios

                ],

            ];

            $dataString = json_encode($data);

            $headers = [

                'Authorization: key=' . $SERVER_API_KEY,

                'Content-Type: application/json',

            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

            curl_setopt($ch, CURLOPT_POST, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);
            if ($response) {
                $message = Message::create([
                    'sender_id' => Auth::id(),
                    'receiver_id' => $request->receiver_id ? $request->receiver_id : $task->user_id,
                    'task_id' => $request->task_id,
                    'message' => $request->message,
                ]);
                if ($message) {
                    return response()->json([
                        'status' => 1,
                        'message' => 'Message send successfully',
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => 'Message not send',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
