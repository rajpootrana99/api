<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;
    use ImageUpload;

    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('', 'Credentials does not match', 401);
        }
        $user = User::where('email', $request->email)->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api Token of ' . $user->name)->plainTextToken
        ], 'Login Successfully');
    }

    public function register(StoreUserRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $user
        ], 'Register Successfully');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success([
            'message' => 'You have successfully logged out and your token has been deleted'
        ]);
    }

    public function update(UpdateUserRequest $request)
    {
        $user = User::find(Auth::id());
        if ($user->email == $request->email) {
            $user->update([
                'name' => $request->name,
            ]);
            $this->storeImage($user);
            return $this->success([
                'user' => $user,
            ], 'User Profile Update Successfully');
        } else {
            return $this->error('', 'You cannot change user email', 401);
        }
    }

    public function storeImage($user)
    {
        $user->update([
            'image' => $this->imagePath('image', 'user', $user),
        ]);
    }
}
