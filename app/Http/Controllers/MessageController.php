<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(){
        return view('message.index');
    }

    public function fetchPeoples(){
        $users = Message::with('sender')->whereNotIn('sender_id', [Auth::id()])->get()->unique('sender_id');
        return response()->json([
            'status' => 1,
            'users' => $users,
        ]);
    }

    public function fetchMessages($sender){
        $messages = Message::with('sender', 'receiver', 'item')->where('sender_id', $sender)
                                    ->orWhere('receiver_id', $sender)
                                    ->get();
        $sender = User::where('id', $sender)->first();
        if($messages){
            return response()->json([
                'status' => true,
                'messages' => $messages,
                'sender' => $sender,
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'No message yet',
            ]);
        }
    }

    public function sendMessage(Request $request){
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'item_id' => $request->item_id,
            'message' => $request->message,
        ]);
        if($message){
            return response()->json([
                'status' => 1,
                'message' => 'Message send successfully',
            ]);
        }
        else {
            return response()->json([
                'status' => 0,
                'message' => 'Message not send',
            ]);
        }
    }
}
