<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Site;
use App\Models\Token;
use App\Models\User;
use App\Traits\HttpResponses;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use HttpResponses;
    use ImageUpload;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'max:255', 'email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return $this->error('', $message->first(), 401);
        }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('', 'Credentials does not match', 401);
        }
        $user = User::where('email', $request->email)->first();
        if ($user->is_approved == 'Not Approved') {
            return $this->error('', 'User is not Approved', 401);
        }
        Token::create([
            'user_id' => $user->id,
            'token' => $request->token,
        ]);
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('Api Token of ' . $user->name)->plainTextToken
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users', 'email'],
            'password' => ['required', 'min:8'],
            'token' => ['required'],
            'phone' => ['required'],
        ]);


        if ($validator->fails()) {
            $message = $validator->errors();
            return $this->error('', $message->first(), 401);
        }

        if ($request->email == "info@insitebg.com.au") {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'is_approved' => 1,
            ]);

            $sites = Site::all();
            $user->sites()->sync($sites, false);
            $user->assignRole('User');
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole('Client');
        }
        Token::create([
            'user_id' => $user->id,
            'token' => $request->token,
        ]);

        return response()->json($user);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success([
            'message' => 'You have successfully logged out and your token has been deleted'
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'email' => ['required', 'email', 'exists:users'],
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return $this->error('', $message->first(), 401);
        }

        $user = User::find(Auth::id());
        if ($user->email == $request->email) {
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
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
