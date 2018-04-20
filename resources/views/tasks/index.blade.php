@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>
    @if(count($tasks) > 0)
        @foreach($tasks as $task)
            <div class="well">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/tasks/{{$task->id}}">{{$task->title}}</a></h3>
                    </div>
                    @foreach($users as $user)
                        @if($user->id == $task->user_id)        
                            <div class="col-md-4 col-sm-4">
                                <h3><a href="/tasks/{{$task->id}}">{{$user->id}}</a></h3>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
        {!! $tasks->appends(Input::except('page'))->render() !!}
    @else
        <p>No tasks found</p>
    @endif
@endsection