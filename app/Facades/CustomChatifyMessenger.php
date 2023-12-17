<?php

namespace App\Facades;

//...
// use Chatify\Facades\ChatifyMessenger;
use App\CustomChatifyMessengerOriginal;
use App\Models\ChMessage as Message;
use App\Models\ChFavorite as Favorite;
use Illuminate\Support\Facades\Storage;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Facade;
// CustomChatifyMessengerOriginal

class CustomChatifyMessenger extends Facade{


    protected static function getFacadeAccessor()
    {
       return 'CustomChatifyMessenger';
    }
}
