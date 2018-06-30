@extends('layouts.app')
@section('content')
<h1 style="margin-top:0; margin-bottom:24px;">Chat</h1>
<hr>
<div class="chat-window">
    <div class="chat-left">
        <div class="users-list-padding media-list">

        @foreach($msgs as $msg)
            @foreach($users as $key => $user)
                @if($user->name !==  Auth::user()->name &&
                ($msg->user_id == $user->id ||$msg->user_recv_id == $user->id ))
                <div class="block-user">
                    <?php
                     if(!isset($counter)) {
                         $link = "/chat/users/" . $user->id;
                         $counter = 1;
                     }

                    ?>
                    <a class="media border-0" onclick="document.getElementById('iframe').src = '/chat/users/{{$user->id}}'" style="cursor:pointer">
                    <div class="img-block">
                        <img class="profile-picture" src="http://www.clker.com/cliparts/B/R/Y/m/P/e/blank-profile-md.png" alt="">
                    </div>
                        <div class="user-msg">
                        <h5 class="list-group-item-heading">{{$user->name}}</h5>
                        <h6 class="msg-time"><?php echo substr($msg->updated_at, 11, 5)?></h6>
                        <h6 class="last-message"><?php echo substr($msg->message, 0, 40)?></h6>
                    </div>
                    </a>
                </div>
                <hr class="hr">
                <?php
                    unset($users[$key]);
                ?>
                @break
                @endif
            @endforeach
        @endforeach
        
        @foreach($users as $user)
            <div class="block-user">
                <a class="media border-0" onclick="document.getElementById('iframe').src = '/chat/users/{{$user->id}}'" style="cursor:pointer">
                <div class="img-block">
                    <img class="profile-picture" src="http://www.clker.com/cliparts/B/R/Y/m/P/e/blank-profile-md.png" alt="">
                </div>
                    <div class="user-msg">
                    <h5 class="list-group-item-heading">{{$user->name}}</h5>
                    <h6 class="msg-time"></h6>
                    <h6 class="last-message"></h6>
                </div>
                </a>
            </div>
            <hr class="hr">        
        @endforeach
        
        </div>
    </div>
    @if(isset($counter))
    <div class="chat-right">
        <iframe id="iframe" class="iframe" src={{$link}} frameborder="0"></iframe>            
    </div>
    @else
    <div class="chat-right">
        <iframe id="iframe" class="iframe" frameborder="0"></iframe>            
    </div>
    @endif
</div>

@endsection