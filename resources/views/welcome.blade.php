@extends('layouts.app')

@section('content')
<h2>Hi {{ Auth::user()->name }}, welcome back</h2>

<div class="square-list">
<div class="small-card">Info</div>
<div class="small-card">Info</div>
<div class="small-card">Info</div>
<div class="graph home-zone">
    <div style="height:200px;" class="graph-full">
        Graphs
    </div>
</div>
</div>

        <div style="height:200px;" class="card-half">
            Tasks:
        </div>
        <div style="height:200px;" class="card-half">
                Projects:
            </div>        


@endsection


@section('script')

        @endsection