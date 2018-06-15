@extends('layouts.app')
@section('content')
<h1 style="margin-top:0; margin-bottom:24px;">Chat</h1>
<hr>
<div class="chat-window">
    <div class="chat-left">
        <div class="users-list-padding media-list">
        @foreach($users as $user)
            @if($user->name !==  Auth::user()->name )
            <div class="block-user">
                <a class="media border-0" href="/chat/users/{{$user->id}}">
                <div class="img-block">
                    <img class="profile-picture" src="http://www.clker.com/cliparts/B/R/Y/m/P/e/blank-profile-md.png" alt="">
                </div>
                    <div class="user-msg">
                    <h5 class="list-group-item-heading">{{$user->name}}</h5>
                    <h6 class="msg-time">08:08</h6>
                    <h6 class="last-message">Lorem Ipsum</h6>
                </div>
                </a>
            </div>
            <hr class="hr">
            @endif
        @endforeach
        </div>
    </div>

    <div class="chat-right">
        <iframe id="iframe" class="iframe" src="/chat/users/2" frameborder="0"></iframe>            
    </div>
</div>

@endsection