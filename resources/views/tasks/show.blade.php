@extends('layouts.app')

@section('content')
    <a href="/tasks" class="btn btn-default">Go Back</a>
    <h1>{{$task->title}}</h1>
    <br><br>
    <div>
        {!!$task->body!!}
    </div>
    <hr>
    <div>
          Deadline:  {{$task->deadline}}
    </div>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $task->user_id)
            <a href="/tasks/{{$task->id}}/edit" class="btn btn-default">Edit</a>

            {!!Form::open(['action' => ['TaskController@destroy', $task->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection