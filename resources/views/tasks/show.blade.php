@extends('layouts.app')

@section('content')
<h1 style="text-align:center;">{{$task->title}}</h1>
<div class="row-flex">
<div class="form-card-2">
  <h4>Description:</h4>
  {!!$task->description!!}
  
  @if($task->checklists && $task->checklists[0] !== "notdone")
      
      <h3>Subtasks:</h3>
        <div>
          <?php $result =""; $counter = 0;?>
        @foreach ($task->checklists as $asign)
          @if (strpos($asign, 'notdone') !== false)
          <?php
            if($counter > 0)
              $asign = substr(substr($asign, 1),0, -7);
            else {
              $asign = substr($asign,0, -7);
              $counter = 1;
            }
            $specialChars = [" ", "!", "#", "$", "%", "&", "'", "(", ")", "*", "+", ",", ".", "/", ":", ";", "<", "=", ">", "?", "@", "[", "]", "^"];
            $stripedAsign = str_replace($specialChars,"", $asign);
            
            ?>
            <p><input class="notdone" type="checkbox" name="{{$stripedAsign}}" id="{{$stripedAsign}}"/><label class="notdone" id="{{$stripedAsign}}2" for="{{$stripedAsign}}" >{{$asign}}</label></p>
              <?php
              $result = $result."<script>$(document).ready( function()  { 
                $('#{$stripedAsign}').change(function(){
                  if($('#{$stripedAsign}').is(':checked'))
                    $.get(window.location.href + '/updateChecklist', {data: '{$asign}', name: '{$stripedAsign}'}, function( data ){
                      $('#{$stripedAsign}').addClass('done');
                      $('#{$stripedAsign}').removeClass('notdone');
                      $('#{$stripedAsign}2').addClass('done');
                      $('#{$stripedAsign}2').removeClass('notdone');
                    });
                  else
                    $.get(window.location.href + '/updateChecklist', {data: '{$asign}', name: '{$stripedAsign}'});
                    $('#{$stripedAsign}').addClass('notdone');
                    $('#{$stripedAsign}').removeClass('done');
                    $('#{$stripedAsign}2').addClass('notdone');
                    $('#{$stripedAsign}2').removeClass('done');
                })
                })</script>";
              ?>
          @else
          <?php if($counter > 0)
              $asign = substr(substr($asign, 1),0, -4);
            else {
              $asign = substr($asign,0, -4);
              $counter = 1;
            }
            $specialChars = [" ", "!", "#", "$", "%", "&", "'", "(", ")", "*", "+", ",", ".", "/", ":", ";", "<", "=", ">", "?", "@", "[", "]", "^"];
            $stripedAsign = str_replace($specialChars,"", $asign);
            ?>
          <p><input class='done' checked type='checkbox' name='{{$stripedAsign}}' id='{{$stripedAsign}}'/><label class='done' id='{{$stripedAsign}}2' for='{{$stripedAsign}}' >{{$asign}}</label></p>
          <?php $result = $result."<script>$(document).ready( function()  { 
$('#{$stripedAsign}').change(function(){
  if($('#{$stripedAsign}').is(':checked'))
    $.get(window.location.href + '/updateChecklist', {data: '{$stripedAsign}', name: '{$stripedAsign}'}, function( data ){
      $('#{$stripedAsign}').addClass('done');
      $('#{$stripedAsign}').removeClass('notdone');
      $('#{$stripedAsign}2').addClass('done');
      $('#{$stripedAsign}2').removeClass('notdone');
    });
  else
    $.get(window.location.href + '/updateChecklist', {data: '{$asign}', name: '{$asign}'});
    $('#{$stripedAsign}').addClass('notdone');
    $('#{$stripedAsign}').removeClass('done');
    $('#{$stripedAsign}2').addClass('notdone');
    $('#{$stripedAsign}2').removeClass('done');
})
})</script>"?>
          @endif
        @endforeach
      </div>
      @endif
      @if( $task->planned_time != 0)
      <h3>Estimated time:</h3>
        <div>
          <p>{{ floor($task->planned_time / 60)}} hours and {{$task->planned_time % 60}} minutes</p>
      </div>
      @endif
    @if($time)
      <div id="taskTimeSpent">Time spent on this task: {{gmdate("H:i:s",$time->working_seconds)}};</div>
      <div style="display:none !important" id="taskPause">{{$time->pause}}</div>
    @else
    <div id="taskTimeSpent">Time spent on this task: 0;</div>
    <div style="display:none !important" id="taskPause">2</div>
    @endif

    </div>

  
  
    <div class="form-card-2">
    <div>
        @if($task->assigned_to)
        <h3>Assigned to:</h3>
        <div>
          @foreach ($task->assigned_to as $asign)
            <p>{{$asign}}</p>
          @endforeach
        </div>
        @endif 
      @if($task->observers)
      <h3>Observers:</h3>
        <div>
          @foreach ($task->observers as $asign)
            <p>{{$asign}}</p>
          @endforeach 
      </div>
      @endif
    </div>
    <hr>
    <div>
          Deadline:  {{$task->deadline}}
    </div>
  </div>
</div>

<div class="form-card">
    @if($task->comment)
    <h3>Comments:</h3>
          <div>
          @for ($i = 0;$i < count($task->comment); $i += 2)
            <h5>{{$task->comment[$i+1]}}: {{$task->comment[$i]}}</h5>
            <hr class="hr" style="border-top:1px solid #999">
          @endfor
        </div>
        @endif
        <br><br>  
    @if($time)
      @if(!$time->done)  
              <button id="taskTimeBtn" type="button" class="btn btn-success" onclick="startTaskTime()" >Start time tracking</button>
              <button id="taskTimeBtn" type="button" class="btn btn-info" onclick="finishTask()" >Finish task</button>
      @endif
    @endif
    @if(!Auth::guest())
        @if(Auth::user()->id == $task->user_id)
            <a href="/tasks/{{$task->id}}/edit" class="btn btn-default">Edit task</a>
            {!!Form::open(['action' => ['TaskController@destroy', $task->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete task', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCommentModal">
  Add comment
</button>
    <!--modal-->
    <div class="modal fade" id="addCommentModal" tabindex="-1" role="dialog" aria-labelledby="addCommentModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="display:inline-block" >Add a comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!!Form::open(['action' => ['TaskController@addComment', $task->id], 'method' => 'POST', 'id' => 'formComment'])!!}
      <div class="modal-body">
        <label for="comment">Comment:</label><br>
        <input class="form-control" id="comment" name="comment" type="text"></input>
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
</div>
@endsection

@push('scripts')
<?php 
if(isset($result))
  echo $result; 
?>
@endpush