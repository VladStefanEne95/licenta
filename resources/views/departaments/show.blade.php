@extends('layouts.app')

@section('content')
    <a href="/departaments" class="btn btn-default">Go Back</a>
    <h1>{{$departament->name}}</h1>
    <br>
    @if(!Auth::guest())
            {!!Form::open(['action' => ['DepartamentController@destroy', $departament->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
            
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changeNameModal">
  Change the name
</button>
    @endif
 
<!-- Modal -->
<div id="changeNameModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change the name</h4>
      </div>
      {!!Form::open(['action' => ['DepartamentController@changeName', $departament->id], 'method' => 'POST', 'id' => 'formComment'])!!}
      <div class="modal-body">
        <label for="comment">New Name:</label><br>
        <input id="name" name="name" type="text"></input>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" value="submit" form="formComment" class="btn btn-primary">Save changes</button>
      </div>
      {!!Form::close()!!}
    </div>
  </div>
  </div>

@endsection