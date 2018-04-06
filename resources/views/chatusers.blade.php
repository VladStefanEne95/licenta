@extends('layouts.app')
@section('content')
    @foreach($users as $user)
        @if($user->name !==  Auth::user()->name )
        <a href="/chat/users/{{$user->id}}">{{$user->name}}</a><br>
        @endif
    @endforeach

@endsection