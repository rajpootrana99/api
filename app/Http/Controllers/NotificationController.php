<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Token;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notification.index');
    }

    public function fetchNotifications()
    {
        $notifications = Notification::all();
        return response()->json([
            'notifications' => $notifications,
        ]);
    }

    public function store(Request $request)
    {
        $response = '';

        $SERVER_API_KEY = 'AAAAFwVn-58:APA91bEkI_A6lAZMm1Jx1rBv8drv8pMRyCnWKzuVKc4LA8W0wzTgXNf0FCevcSkIegRwM2y4T0h68_jMnP66uOjZNY8B2DL5k03-POUfDXJzcYgnHwSFQB6cq2NEZXo1nqZTygd8GJbX';

        $tokens = Token::all();

        foreach ($tokens as $token) {
            $token_1 = $token->token;

            $data = [
                "registration_ids" => [
                    $token_1
                ],

                "notification" => [

                    "title" => $request->input('title'),

                    "body" => $request->input('body'),

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
                Notification::create([
                    'title' => $request->input('title'),
                    'body' => $request->input('body'),
                ]);
                return response()->json(['status' => 1, 'message' => 'Notification Send Successfully']);
            } else {
                return response()->json(['status' => 0, 'message' => 'Notification Not Send']);
            }
        }
    }

    public function destroy($notification)
    {
        $notification = Notification::find($notification);
        if (!$notification) {
            return response()->json([
                'status' => false,
                'messaqe' => 'Notification not exist'
            ]);
        }
        $notification->delete();
        return response()->json([
            'status' => true,
            'message' => 'Notification Deleted Successfully'
        ]);
    }
}
