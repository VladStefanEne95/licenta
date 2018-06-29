@extends('layouts.app')
@section('content')
<h1>{{$user->name}}</h1>
{!! Form::open(['action' => 'GetTimeDataController@addKey', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('apikey', 'Api Key')}}
            {{Form::text('apikey', '', ['class' => 'form-control', 'placeholder' => 'RescueTime api key'])}}
        </div>
        <input style="display:none !important;" name="userId" type="text" value={{$user->id}}>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection