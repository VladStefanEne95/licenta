@extends('layouts.app')

@section('content')
    <h1>Positions</h1>
    @if(count($positions) > 0)
        @foreach($positions as $position)
            <div class="well">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/positions/{{$position->id}}">{{$position->name}}</a></h3>
                    </div>
                </div>
            </div>
        @endforeach
        
    @else
        <p>Nada</p>
    @endif
@endsection