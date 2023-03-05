<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Task;
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
        if ($request->receiver_id == null) {
            $task = Task::with('user')->find($request->task_id);
        }
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
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Message not send',
            ]);
        }
    }
}
