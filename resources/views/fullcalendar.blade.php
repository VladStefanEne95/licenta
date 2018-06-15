@extends('layouts.app')
@section('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Calendar</div>
                <button id ="addEvent">Add Event</button>
<div class="panel-body">
                    {!! $calendar->calendar() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Event</h4>
        </div>
        <div class="modal-body">
        <form method="post" action='/addEvent'>
        <div class="form-group" style="text-align:center;">
        {{ csrf_field() }}
                            

                            <div style="width:80%; margin:0 auto;">
                                Title
                                <input type="text"  class="form-control" name="title" required>
                                Start Date
                                <input type="date" class="form-control" name="start" required>
                                End Date
                                <input type="date" class="form-control" name="end" required>

                            </div>
            </div>
            <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
        </form>
        </div>
      </div>
    </div>
</div>



@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
{!! $calendar->script() !!}

<script>
        $('#addEvent').click(function(){
        $('#myModal').modal('show');
    })
</script>
@endsection