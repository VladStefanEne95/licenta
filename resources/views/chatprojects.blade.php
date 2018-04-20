@extends('layouts.app')
@section('content')
    @foreach($projects as $project)
        <a href="/chat/projects/{{$project->id}}">{{$project->name}}</a><br>
    @endforeach

@endsection