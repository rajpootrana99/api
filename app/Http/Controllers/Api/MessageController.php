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
    public function sendMessage(Request $request){
        $validator = Validator::make($request->all(),[
            'item_id' => ['required'],
            'message' => ['required', 'string'],
        ]);

        if($validator->fails()){
            $message = $validator->errors();
            return $this->error('', $message->first(), 401);
        }

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => 1,
            'item_id' => $request->item_id,
            'message' => $request->message,
        ]);
        if($message){
            return $this->success($message, 'Message Send Successfully', 200);
        }
        else {
            return $this->error('', 'Message not send Successfully', 401);
        }
    }
}
