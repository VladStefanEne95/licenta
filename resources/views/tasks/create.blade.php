@extends('layouts.app')
@section('content')

    <h1>Create Task</h1>

 
    {!! Form::open(['action' => 'TaskController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'description'])}}
        </div>
        <div class="form-group">
            {{Form::label('asigned_to', 'Assign to')}}
            {{Form::text('assigned_to', '',['id' => 'skills' , 'class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('checklists', 'Checklist(comma separated)')}}
            {{Form::text('checklists', '', ['class' => 'form-control', 'placeholder' => 'Checklist'])}}
        </div>
        <div class="form-group">
            {{Form::label('observers', 'Observers')}}
            {{Form::text('observers', '',['id' => 'observers' , 'class' => 'form-control'])}}
        </div>
        <div class="form-group">
                {{Form::label('deadline', 'Deadline')}}
                {{Form::date('deadline', '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('priority', 'Priority')}}
            {{ Form::select('priority', ['low', 'medium', 'high', 'top priority' ], null, ['id' => 'priority' , 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{Form::label('project', 'Project')}}
            {{ Form::select('project', ['1', '2', '3', '4' ], null, ['id' => 'todo' , 'class' => 'form-control']) }}
        </div>
        <div>
            <p>Estimated time</p>
        <label>Number of hours:</label>
        <input name="hours" type="number"  />
        <label>Number of minutes:</label>
        <input name="minutes" type="number" max="60" />
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
  
@endsection

