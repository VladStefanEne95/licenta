@extends('layouts.app')

@section('content')
    <h1>Departaments</h1>
    @if(count($departaments) > 0)
        @foreach($departaments as $departament)
            <div class="well">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/departaments/{{$departament->id}}">{{$departament->name}}</a></h3>
                    </div>
                </div>
            </div>
        @endforeach
        
    @else
        <p>Nada</p>
    @endif
@endsection