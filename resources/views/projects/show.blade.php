@extends('layouts.app')

@section('content')
    <a href="/projects" class="btn btn-default">Go Back</a>
    <h1>{{$project->name}}</h1>
    <div>{!!$project->description!!}</div>
    <br>
    @if(!Auth::guest())
            {!!Form::open(['action' => ['ProjectsController@destroy', $project->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
            
    @endif
 
@endsection