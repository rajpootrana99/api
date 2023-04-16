<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Task;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            $SERVER_API_KEY = 'AIzaSyAoI_RgOQRZiZMgoKIaWyUJrVkffcZW9os';

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
