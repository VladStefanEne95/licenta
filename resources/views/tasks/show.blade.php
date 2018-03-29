@extends('layouts.app')

@section('content')
    <a href="/tasks" class="btn btn-default">Go Back</a>
    <h1>{{$task->title}}</h1>
    <br><br>
    @if($time)
      <div id="taskTimeSpent">Time spent on this task: {{$time->working_seconds}};</div>
      <div style="display:none !important" id="taskPause">{{$time->pause}}</div>
    @else
    <div id="taskTimeSpent">Time spent on this task: 0;</div>
    <div style="display:none !important" id="taskPause">2</div>
    @endif
    <div>
    
        {!!$task->description!!}
        <h3>Assigned to:</h3>
        <div>
        @foreach ($task->assigned_to as $asign)
          <p>{{$asign}}</p>
        @endforeach
      </div>
      <h3>Observers:</h3>
        <div>
        @foreach ($task->observers as $asign)
          <p>{{$asign}}</p>
        @endforeach 
      </div>
      <h3>TO DO:</h3>
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
              
              ?>
            <p><input class="notdone" type="checkbox" name="{{$asign}}" id="{{$asign}}"/><label class="notdone" id="{{$asign}}2" for="{{$asign}}" >{{$asign}}</label></p>
              <?php
              $result = $result."<script>$(document).ready( function()  { 
                $('#{$asign}').change(function(){
                  if($('#{$asign}').is(':checked'))
                    $.get(window.location.href + '/updateChecklist', {data: 1, name: '{$asign}'}, function( data ){
                      $('#{$asign}').addClass('done');
                      $('#{$asign}').removeClass('notdone');
                      $('#{$asign}2').addClass('done');
                      $('#{$asign}2').removeClass('notdone');
                    });
                  else
                    $.get(window.location.href + '/updateChecklist', {data: 0, name: '{$asign}'});
                    $('#{$asign}').addClass('notdone');
                    $('#{$asign}').removeClass('done');
                    $('#{$asign}2').addClass('notdone');
                    $('#{$asign}2').removeClass('done');
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
            ?>
          <p><input class='done' checked type='checkbox' name='{{$asign}}' id='{{$asign}}'/><label class='done' id='{{$asign}}2' for='{{$asign}}' >{{$asign}}</label></p>
          <?php $result = $result."<script>$(document).ready( function()  { 
$('#{$asign}').change(function(){
  if($('#{$asign}').is(':checked'))
    $.get(window.location.href + '/updateChecklist', {data: 1, name: '{$asign}'}, function( data ){
      $('#{$asign}').addClass('done');
      $('#{$asign}').removeClass('notdone');
      $('#{$asign}2').addClass('done');
      $('#{$asign}2').removeClass('notdone');
    });
  else
    $.get(window.location.href + '/updateChecklist', {data: 0, name: '{$asign}'});
    $('#{$asign}').addClass('notdone');
    $('#{$asign}').removeClass('done');
    $('#{$asign}2').addClass('notdone');
    $('#{$asign}2').removeClass('done');
})
})</script>"?>
          @endif
        @endforeach 
      </div>
      <h3>Estimated time:</h3>
        <div>
          <p>{{ floor($task->planned_time / 60)}} hours and {{$task->planned_time % 60}} minutes</p>
      </div>
    </div>
    <hr>
    <div>
          Deadline:  {{$task->deadline}}
    </div>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $task->user_id)
            <a href="/tasks/{{$task->id}}/edit" class="btn btn-default">Edit</a>
            <button id="taskTimeBtn" type="button" class="btn btn-success" onclick="startTaskTime()" >Start time tracking</button>

            {!!Form::open(['action' => ['TaskController@destroy', $task->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
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
        <input id="comment" type="text"></input>
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

@push('scripts')
<?php echo $result; 
// echo "<script>$(document).ready( function()  { 
// $('#asd').change(function(){
//   if($('#asd').is(':checked'))
//     $.get(window.location.href + '/updateChecklist', {data: 1, name: 'asd'}, function( data ){
//       $('#asd').addClass('done');
//       $('#asd').removeClass('notdone');
//       $('#asd2').addClass('done');
//       $('#asd2').removeClass('notdone');
//     });
//   else
//     $.get(window.location.href + '/updateChecklist', {data: 0, name: 'asd'});
//     $('#asd').addClass('notdone');
//     $('#asd').removeClass('done');
//     $('#asd2').addClass('notdone');
//     $('#asd2').removeClass('done');
// })
//})</script>";?>
@endpush