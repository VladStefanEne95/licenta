@extends('layouts.app')
@section('content')

    <h1 style="text-align:center">Edit Task</h1>
 <div class="form-card">
    {!! Form::open(['action' => ['TaskController@update', $task->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('title', 'Title')}}
            </div>
            <div class="col-md-9">
                {{Form::text('title', $task->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('description', 'Description')}}
            </div>
            <div class="col-md-9">
                {{Form::textarea('description', $task->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'description'])}}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('assigned_to', 'Assign to')}}
            </div>
            <div class="col-md-9">
                {{Form::text('assigned_to', '',['id' => 'skills' , 'class' => 'form-control'])}}
            </div>   
         </div>
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('checklists', 'Checklist(comma separated)')}}
            </div>
            <div class="col-md-9">
            {{Form::text('checklists', '', ['class' => 'form-control', 'placeholder' => 'Checklist'])}}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('observers', 'Observers')}}
            </div>
            <div class="col-md-9">
                {{Form::text('observers', '',['id' => 'observers' , 'class' => 'form-control'])}}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('deadline', 'Deadline')}}
            </div>
            <div class="col-md-9">
                {{Form::date('deadline', $task->deadline, ['class' => 'form-control'])}}
            </div>    
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('priority', 'Priority')}}
            </div>
            <div class="col-md-9">
             {{ Form::select('priority', ['low', 'medium', 'high', 'top priority' ], null, ['id' => 'priority' , 'class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('project', 'Project')}}
            </div>
            <div class="col-md-9">
            <select class="form-control" name="project" id="todo">
                <option value="0">None</option>
                @foreach($projects as $project)
                    <option class="form-control" value="{{$project->id}}">{{$project->name}}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div>
        <div class="col-md-3">
            <p style="font-weight:bold; color:#6B6F82">Estimated time</p>
        </div>
        <div class="col-md-9">
        <label>Number of hours:</label>
        <input class="form-control" name="hours" type="number"  />
        <label>Number of minutes:</label>
        <input class="form-control" name="minutes" type="number" max="60" />
        </div>
    </div>
    <div style="text-align:center">
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}
    </div>
@endsection

