@extends('layouts.app')
@section('content')

<h1>Users</h1>
<table class="users-table">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
@foreach($users as $user)
    <tr>    
        <td>{{$user->id}}</td>
        <td class="blue-table"> <img style="width:40px; height:40px;" src="http://www.clker.com/cliparts/B/R/Y/m/P/e/blank-profile-md.png"/> &nbsp {{$user->name}}</td>
        <td class="blue-table">{{$user->email}}</td>
        <td class="blue-table">
            <a href="/delete-userwww/{{$user->id}}"><i title="Delete user" class="glyphicon glyphicon-remove"></i></a>
            <span id="showme{{$user->id}}">   
                <i title="View reports" class="glyphicon glyphicon-info-sign"></i>
        </span>
        <div class="webui-popover-content" style="text-align:center" id="myContent{{$user->id}}">
            <h4>View reports for {{$user->name}}</h4>
            <hr class="hr">
            <div class="pop-rep" onclick="window.location.href='/get-productivity/{{$user->id}}'" ><a href="/get-productivity/{{$user->id}}">Productivity</a></div>
            <div class="pop-rep" onclick="window.location.href='/get-entertainment/{{$user->id}}'" ><a href="/get-entertainment/{{$user->id}}">Entertainment</a></div>
            <div class="pop-rep" onclick="window.location.href='/get-social/{{$user->id}}'"><a href="/get-social/{{$user->id}}">Social media</a></div>
            <div class="pop-rep" onclick="window.location.href='/get-overview/{{$user->id}}'"><a href="/get-overview/{{$user->id}}">Overview</a></div>
            <div class="pop-rep" onclick="window.location.href='/report-deadline/{{$user->id}}'"><a href="/report-deadline/{{$user->id}}">Deadline</a></div>
            <div class="pop-rep" onclick="window.location.href='/report-time-spent/{{$user->id}}'"><a href="/report-time-spent/{{$user->id}}">Time on tasks</a></div>
            <div class="pop-rep" onclick="window.location.href='/report-hours/{{$user->id}}'"><a href="/report-hours/{{$user->id}}">Working time</a></div>
        </div>
            <a href="/chat/{{$user->id}}"><i title="Message" class="glyphicon glyphicon-envelope" ></i></a>
        
        </td>
    </tr>    
@endforeach  

</table>
@endsection

@section('script')

<script src="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.js"></script>
@foreach($users as $user)
<script>
$('#showme{{$user->id}}').webuiPopover({url:'#myContent{{$user->id }}', placement:'right'});
</script>
@endforeach
@endsection

