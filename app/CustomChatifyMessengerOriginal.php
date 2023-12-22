<?php

namespace App;

//...
use Chatify\ChatifyMessenger;
use App\Models\ChMessage as Message;
use App\Models\ChFavorite as Favorite;
use Illuminate\Support\Facades\Storage;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;
use Exception;
// use Illuminate\Support\Facades\Facade;

class CustomChatifyMessengerOriginal extends ChatifyMessenger{


    /**
     * Get user with avatar (formatted).
     *
     * @param Collection $user
     * @return Collection
     */
    public function getUserWithAvatar($user)
    {
        if ($user->avatar == 'avatar.png' && config('chatify.gravatar.enabled')) {
            $imageSize = config('chatify.gravatar.image_size');
            $imageset = config('chatify.gravatar.imageset');
            $user->avatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '?s=' . $imageSize . '&d=' . $imageset;
        } else {
            $user->avatar = preg_replace("/(localhost)/", app('request')->getHttpHost(), self::getUserAvatarUrl($user->avatar));
        }
        return $user;
    }

    /**
     * Make messages between the sender [Auth user] and
     * the receiver [User id] as seen.
     *
     * @param int $user_id
     * @return bool
     */
    public function makeSeen($user_task_id)
    {
        Message::Where("task_id", $user_task_id[1])
                ->where('from_id', $user_task_id[0])
                ->where('to_id', Auth::user()->id)
                ->where('seen', 0)
                ->update(['seen' => 1]);
        return 1;
    }

    public function countUnseenTaskMessages($task_id)
    {
        return Message::where('task_id', $task_id)->where('to_id', Auth::user()->id)->where('seen', 0)->count();
    }

    /**
     * Count Unseen messages
     *
     * @param int $user_id
     * @return Collection
     */
    public function countUnseenMessages($user_task)
    {
        return Message::where('task_id', $user_task[1])->where('from_id', $user_task[0])->where('to_id', Auth::user()->id)->where('seen', 0)->count();
    }


    /**
     * Default fetch messages query between a Sender and Receiver.
     *
     * @param mixed $user_id
     * @return Message|\Illuminate\Database\Eloquent\Builder
     */
    public function fetchMessagesQuery($user_task)
    {
        // return "Working";
        return Message::where('task_id', Auth::user()->id == $user_task[1] ? null : $user_task[1])
                ->where(function ($query) use ($user_task) {
                    $query->where(function ($query) use ($user_task) {
                      $query->where('from_id', Auth::user()->id)
                            ->where('to_id', $user_task[0]);
                  })
                  ->orWhere(function ($query) use ($user_task) {
                      $query->where('from_id', $user_task[0])
                            ->where('to_id', Auth::user()->id);
                  });
                })
                  ;
    }



    /**
     * Get last message for a specific user
     *
     * @param int $user_id
     * @return Message|Collection|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getLastMessageQuery($user_task)
    {
        // return "Working";
        return $this->fetchMessagesQuery([$user_task[0],$user_task[1]])->latest()->first();
    }

    /**
     * Get user list's item data [Contact Itme]
     * (e.g. User data, Last message, Unseen Counter...)
     *
     * @param int $messenger_id
     * @param Collection $user
     * @return string
     */
    public function getContactItem($user_and_task_id)
    {
        try {
            // get last message
            $lastMessage = $this->getLastMessageQuery([$user_and_task_id[0]->id, $user_and_task_id[1]]);

            // Get Unseen messages counter
            $unseenCounter = $this->countUnseenMessages([$user_and_task_id[0]->id, $user_and_task_id[1]]);
            if ($lastMessage) {
                $lastMessage->created_at = $lastMessage->created_at->toIso8601String();
                $lastMessage->timeAgo = $lastMessage->created_at->diffForHumans();
            }
            return view('Chatify::layouts.listItem', [
                'get' => 'users',
                'user' => $this->getUserWithAvatar($user_and_task_id[0]),
                'lastMessage' => $lastMessage,
                'unseenCounter' => $unseenCounter,
                ])->render();
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    /**
     * Get shared photos of the conversation
     *
     * @param int $user_id
     * @return array
     */
    public function getSharedPhotos($user_task)
    {
        $images = array(); // Default
        // Get messages
        $msgs = $this->fetchMessagesQuery([$user_task[0],$user_task[1]])->orderBy('created_at', 'DESC');
        if ($msgs->count() > 0) {
            foreach ($msgs->get() as $msg) {
                // If message has attachment
                if ($msg->attachment) {
                    $attachment = json_decode($msg->attachment);
                    // determine the type of the attachment
                    in_array(pathinfo($attachment->new_name, PATHINFO_EXTENSION), $this->getAllowedImages())
                    ? array_push($images, $attachment->new_name) : '';
                }
            }
        }
        return $images;
    }


    /**
     * create a new message to database
     *
     * @param array $data
     * @return Message
     */
    public function newMessage($data)
    {
        $message = new Message();
        $message->task_id = $data['task_id'];
        $message->from_id = $data['from_id'];
        $message->to_id = $data['to_id'];
        $message->body = $data['body'];
        $message->attachment = $data['attachment'];
        $message->save();
        return $message;
    }



    /**
     * Fetch & parse message and return the message card
     * view as a response.
     *
     * @param Message $prefetchedMessage
     * @param int $id
     * @return array
     */
    public function parseMessage($prefetchedMessage = null, $id = null)
    {
        $msg = null;
        $attachment = null;
        $attachment_type = null;
        $attachment_title = null;
        if (!!$prefetchedMessage) {
            $msg = $prefetchedMessage;
        } else {
            $msg = Message::where('id', $id)->first();
            if(!$msg){
                return [];
            }
        }
        if (isset($msg->attachment)) {
            $attachmentOBJ = json_decode($msg->attachment);
            $attachment = $attachmentOBJ->new_name;
            $attachment_title = htmlentities(trim($attachmentOBJ->old_name), ENT_QUOTES, 'UTF-8');
            $ext = pathinfo($attachment, PATHINFO_EXTENSION);
            $attachment_type = in_array($ext, $this->getAllowedImages()) ? 'image' : 'file';
        }
        return [
            'id' => $msg->id,
            'task_id' => $msg->task_id,
            'from_id' => $msg->from_id,
            'to_id' => $msg->to_id,
            'message' => $msg->body,
            'attachment' => (object) [
                'file' => $attachment,
                'title' => $attachment_title,
                'type' => $attachment_type
            ],
            'timeAgo' => $msg->created_at->diffForHumans(),
            'created_at' => $msg->created_at->toIso8601String(),
            'isSender' => ($msg->from_id == Auth::user()->id),
            'seen' => $msg->seen,
        ];
    }
}
