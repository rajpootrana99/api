{{-- -------------------- Saved Messages -------------------- --}}
@if($get == 'saved')
    <table class="messenger-list-item" data-contact="{{ Auth::user()->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
            <div class="saved-messages avatar av-m">
                <span class="far fa-bookmark"></span>
            </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ Auth::user()->id }}" data-type="user">Saved Messages <span>You</span></p>
                <span>Save messages secretly</span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- Contact list -------------------- --}}
@if($get == 'users' && !!$lastMessage)
<?php
$lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
$lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8').'..' : $lastMessageBody;
?>
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td style="position: relative">
            @if($user->active_status)
                <span class="activeStatus"></span>
            @endif
        <div class="avatar av-m"
        style="background-image: url('{{$user->avatar}}');">
        </div>
        </td>
        {{-- center side --}}
        <td>
        <p data-id="{{ $user->id }}" data-type="user">
            {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
            <span class="contact-item-time" data-time="{{$lastMessage->created_at}}">{{ $lastMessage->timeAgo }}</span></p>
        <span>
            {{-- Last Message user indicator --}}
            {!!
                $lastMessage->from_id == Auth::user()->id
                ? '<span class="lastMessageIndicator">You :</span>'
                : ''
            !!}
            {{-- Last message body --}}
            @if($lastMessage->attachment == null)
            {!!
                $lastMessageBody
            !!}
            @else
            <span class="fas fa-file"></span> Attachment
            @endif
        </span>
        {{-- New messages counter --}}
            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
        </td>
    </tr>
</table>
@endif

{{-- -------------------- Tasks list -------------------- --}}
@if($get == 'tasks')
@php
    $task_status = [
        "Pending" => ["warning", "clock", "--warning"],
        "Approved" => ["primary", "check-circle", "--success"]
];
@endphp
<table class="messenger-list-item" data-task="{{ $task->id }}" data-entity="{{ $entity->id }}" data-site="{{ $site->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td style="position: relative">
        <div class="avatar av-m" style="background-color: transparent;border:0;">
            <i class="fas fa-{{$task_status[$task->status][1]}} av-m" style="width: max-content;color: var({{$task_status[$task->status][2]}});"></i>
        </div>
        {{-- <span class="badge badge-pill badge-{{$task_status[$task->status][0]}}">Primary</span> --}}
        </td>
        {{-- center side --}}
        <td>
        <span>
            <span class="text-muted text-truncate" style="width: 100%;display: inline-block;">
                {{$entity->entity}} > {{ $site->site }}
            </span>
        </span>
        <p class="text-truncate " >
            {{$task->title}}

            {!! $unseen !!}
        </p>

        <span>
        </span>
        </td>
    </tr>
</table>
@endif


{{-- -------------------- Search Item -------------------- --}}
@if($get == 'search_item')
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td>
        <div class="avatar av-m"
        style="background-image: url('{{ $user->avatar }}');">
        </div>
        </td>
        {{-- center side --}}
        <td>
            <p data-id="{{ $user->id }}" data-type="user">
            {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
        </td>

    </tr>
</table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedPhoto')
<div class="shared-photo chat-image" style="background-image: url('{{ preg_replace("/(localhost)/", app('request')->getHttpHost(), $image) }}')"></div>
@endif


