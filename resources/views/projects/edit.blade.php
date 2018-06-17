@extends('layouts.app')
@section('content')

    <h1 style="text-align:center">Edit Project</h1>
 <div class="form-card">
    {!! Form::open(['action' => ['ProjectsController@update', $project->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('name', 'Title')}}
            </div>
            <div class="col-md-9">
                {{Form::text('name', $project->name, ['class' => 'form-control', 'placeholder' => 'Title'])}}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('description', 'Description')}}
            </div>
            <div class="col-md-9">
                {{Form::textarea('description', $project->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'description'])}}
            </div>
        </div>


        <div class="form-group">
                <div class="col-md-3">
                    {{Form::label('client', 'Client')}}
                </div>
                <div class="col-md-9">
                    {{Form::text('client', $project->client, ['class' => 'form-control', 'placeholder' => 'Client'])}}
                </div>
            </div>

            <div class="form-group">
                    <div class="col-md-3">
                        {{Form::label('users', 'Members')}}
                    </div>
                    <div class="col-md-9">
                        {{Form::text('users', "", ['class' => 'form-control', 'placeholder' => 'Members'])}}
                    </div>
                </div>
        
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('deadline', 'Deadline')}}
            </div>
            <div class="col-md-9">
                {{Form::date('deadline', $project->deadline, ['class' => 'form-control'])}}
            </div>    
        </div>
        <div style="text-align:center;">
            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        </div>
    </div>
    {!! Form::close() !!}
    </div>
@endsection

