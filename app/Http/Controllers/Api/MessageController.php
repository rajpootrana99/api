<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request){
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => 1,
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
