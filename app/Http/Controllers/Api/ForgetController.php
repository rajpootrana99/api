<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetRequest;
use App\Http\Requests\ResetRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Traits\HttpResponses;

class ForgetController extends Controller
{
    use HttpResponses; 
    public function forget(ForgetRequest $request){
        $email = $request->input('email');
        if(User::where('email', $email)->doesntExist()){
            return $this->error('', 'User doesn\'t exist!', 404);
        }
        $token = random_int(1000, 9999);

        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);

            Mail::send('Mails.forgot', ['token' => $token], function (Message $message) use ($email){
                $message->to($email);
                $message->subject('Reset your Password');
            });

            return $this->success([
                'message' => 'Check your Email'
            ]);
        }catch (\Exception $exception){
            return $this->error('', $exception->getMessage(), 400);
        }
    }

    public function reset(ResetRequest $request){
        /** @var User $user */
        $token = $request->input('token');
        if(!$passwordResets = DB::table('password_resets')->where('token', $token)->first()){
            return $this->error('', 'Invalid Token', 400);
        }

        if(!$user = User::where('email', $passwordResets->email)->first()){
            return $this->error('', 'User doesn\'t exist!', 404);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();
        return $this->success([
            'message' => 'Password Reset Successfully'
        ]);
    }

    public function checkToken(Request $request){
        $token = $request->input('token');
        if(!$passwordResets = DB::table('password_resets')->where('token', $token)->first()){
            return $this->error('', 'Invalid Token', 400);
        }
        return $this->success([
            'message' => 'Token Check Successfully'
        ]);
    }
}
