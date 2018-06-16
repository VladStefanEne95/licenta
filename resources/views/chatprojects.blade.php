@extends('layouts.app')
@section('content')
<h1 style="margin-top:0; margin-bottom:24px;">Chat</h1>
<hr>
<div class="chat-window">
    <div class="chat-left">
        <div class="users-list-padding media-list">

        @foreach($msgs as $msg)
            @foreach($projects as $key => $project)
                @if($msg->project == $project->id )
                <div class="block-user">
                    <?php
                     if(!isset($counter)) {
                         $link = "/chat/projects/" . $project->id;
                         $counter = 1;
                     }

                    ?>
                    <a class="media border-0" onclick="document.getElementById('iframe').src = '/chat/projects/{{$project->id}}'" style="cursor:pointer">
                    <div class="img-block">
                        <img class="profile-picture" src="http://www.clker.com/cliparts/B/R/Y/m/P/e/blank-profile-md.png" alt="">
                    </div>
                        <div class="user-msg">
                        <h5 class="list-group-item-heading">{{$project->name}}</h5>
                        <h6 class="msg-time"><?php echo substr($msg->updated_at, 11, 5)?></h6>
                        <h6 class="last-message"><?php echo substr($msg->message, 0, 40)?></h6>
                    </div>
                    </a>
                </div>
                <hr class="hr">
                <?php
                    unset($projects[$key]);
                ?>
                @break
                @endif
            @endforeach
        @endforeach
        
        @foreach($projects as $project)
            <div class="block-user">
                <a class="media border-0" onclick="document.getElementById('iframe').src = '/chat/projects/{{$project->id}}'" style="cursor:pointer">
                <div class="img-block">
                    <img class="profile-picture" src="http://www.clker.com/cliparts/B/R/Y/m/P/e/blank-profile-md.png" alt="">
                </div>
                    <div class="user-msg">
                    <h5 class="list-group-item-heading">{{$project->name}}</h5>
                    <h6 class="msg-time"></h6>
                    <h6 class="last-message"></h6>
                </div>
                </a>
            </div>
            <hr class="hr">        
        @endforeach
        
        </div>
    </div>

    <div class="chat-right">
        <iframe id="iframe" class="iframe" src={{$link}} frameborder="0"></iframe>            
    </div>
</div>

@endsection