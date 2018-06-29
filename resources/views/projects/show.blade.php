@extends('layouts.app')

@section('content')
<h1 style="text-align:center;">{{$project->name}}</h1>
@if(!Auth::guest())
            @if(Auth::user()->name == $project->owner)
                <a href="/projects/{{$project->id}}/edit" class="btn btn-warning">Edit project</a>
                {!!Form::open(['action' => ['ProjectsController@destroy', $project->id], 'method' => 'POST', 'class' => 'pull-left'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete project', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
            @endif
        @endif

<div class="row-flex">
<div class="form-card-2">
  <h4>Description</h4>
  {!!$project->description!!}
  <div>
        <h4>Deadline</h4>  {{$project->deadline}}
  </div>
  <div>
        @if($project->users)
        <h4>Assigned to:</h4>
        <?php 
        $myArray = explode(',', $project->users);
        $myArray = str_replace("[", "",$myArray);
        $myArray = str_replace("]", "",$myArray);
        $myArray = str_replace('"', "",$myArray);
        for($i = 0; $i < count($myArray); $i++) {
            echo "<div style='display:inline-block; margin-left:5px;margin-right:5px;'>  $myArray[$i]</div>";
        }
        ?>
        @endif 
    </div>
  <h4>Cient</h4>
  {{$project->client}}
  <h4>Owner</h4>
  {{$project->owner}}
    </div>

  
    <div class="form-card-2">
    <h4>Tasks:</h4>
    @foreach($tasks as $task)
    <a href="/tasks/{{$task->id}}"><div>{{$task->title}} <br><small>{!!$task->description!!}</small></div></a>
    <hr class="hr"><br>
    @endforeach
  </div>
</div>

 


@endsection

@push('scripts')
<?php 
if(isset($result))
  echo $result; 
?>
@endpush