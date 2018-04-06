@extends('layouts.app')
@section('content')

            <h1>Chat</h1>
            <span class="badge pull-right">@{{ usersInRoom.length }}</span>
            <chat-log :messages="messages"></chat-log>
            <chat-composer current-user="{{ Auth::user()->name }}" v-on:messageSent="addMessage"></chat-composer>
@endsection
