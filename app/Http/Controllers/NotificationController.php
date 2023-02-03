<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
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

        $SERVER_API_KEY = 'AAAAH13Wawo:APA91bE61OXDrCbPrhfsXw91djC-QKAfgqVBfFaL3ta9pexkMuTmOTfa_xgryZwN45KrFgM-G_VVN8zpbdAfWrIXEEKClwMY3eImdYGUzsx7hFo_HXUxTlDJ0GhXShOxW9y-D5SB4kFI';


        $data = [
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
