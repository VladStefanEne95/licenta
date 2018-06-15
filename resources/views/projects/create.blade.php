@extends('layouts.app')
@section('content')

    <h1>Create Project</h1>

 
    {!! Form::open(['action' => 'ProjectsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description'])}}
        </div>
        <div class="form-group">
            {{Form::label('client', 'Client')}}
            {{Form::text('client', '', ['class' => 'form-control', 'placeholder' => 'Client'])}}
        </div>
        <div class="form-group">
            {{Form::label('users', 'Members')}}
            {{Form::text('users', '', ['id' => 'skills', 'class' => 'form-control', 'placeholder' => 'Members'])}}
        </div>
        <div class="form-group">
            {{Form::label('deadline', 'Deadline')}}
            {{Form::date('deadline', '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('owner', 'Supervisor')}}
            {{Form::text('owner', '', ['class' => 'form-control', 'placeholder' => 'Supervisorc'])}}
        </div>

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
  
@endsection

