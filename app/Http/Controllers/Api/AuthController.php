<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request){
        if(!Auth::attempt($request->only(['email', 'password']))){
            return $this->error('', 'Credentials does not match', 401);
        }
        $user = User::where('email', $request->email)->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api Token of '.$user->name)->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api Token of '.$user->name)->plainTextToken
        ]);

    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return $this->success([
            'message' => 'You have successfully logged out and your token has been deleted'
        ]);
    }
}
