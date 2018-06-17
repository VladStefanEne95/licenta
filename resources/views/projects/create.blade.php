@extends('layouts.app')
@section('content')

    <h1 style="text-align:center">Create Project</h1>

    <div class="form-card"> 
    {!! Form::open(['action' => 'ProjectsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
        <div class="col-md-3">
            {{Form::label('name', 'Name')}}
        </div>
        <div class="col-md-9">
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
        <div class="col-md-3">
            {{Form::label('description', 'Description')}}
        </div>
        <div class="col-md-9">
            {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description'])}}
        </div>
        </div>
        <div class="form-group">
        <div class="col-md-3">
            {{Form::label('client', 'Client')}}
        </div>
        <div class="col-md-9">
            {{Form::text('client', '', ['class' => 'form-control', 'placeholder' => 'Client'])}}
        </div>
        </div>
        <div class="form-group">
        <div class="col-md-3">
            {{Form::label('users', 'Members')}}
        </div>
        <div class="col-md-9">
            {{Form::text('users', '', ['id' => 'skills', 'class' => 'form-control', 'placeholder' => 'Members'])}}
        </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('deadline', 'Deadline')}}
            </div>
            <div class="col-md-9">
                {{Form::date('deadline', '', ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('owner', 'Supervisor')}}
            </div>
            <div class="col-md-9">
                {{Form::text('owner', '', ['class' => 'form-control', 'placeholder' => 'Supervisor'])}}
            </div>
        </div>
    </div>
    <div style="text-align:center">
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}
</div>
@endsection

