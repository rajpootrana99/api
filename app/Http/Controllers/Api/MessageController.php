<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    use HttpResponses;
    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_id' => ['required'],
            'message' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return $this->error('', $message->first(), 401);
        }

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => 1,
            'task_id' => $request->task_id,
            'message' => $request->message,
        ]);
        if ($message) {
            return response()->json($message);
        } else {
            return response()->json('Message not send Successfully');
        }
    }

    public function fetchMessages($task)
    {
        $messages = Message::with('sender', 'receiver', 'task')->where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())->orWhere('task_id', $task)
            ->get();
        if ($messages) {
            return response()->json($messages);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No message yet',
            ]);
        }
    }
}
