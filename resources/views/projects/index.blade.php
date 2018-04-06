@extends('layouts.app')

@section('content')
    <h1>Projectss</h1>
    @if(count($projects) > 0)
        @foreach($projects as $project)
            <div class="well">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/projects/{{$project->id}}">{{$project->name}}</a></h3>
                    </div>
                </div>
            </div>
        @endforeach
        
    @else
        <p>Nada</p>
    @endif
@endsection