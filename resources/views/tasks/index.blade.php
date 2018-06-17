@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>
    @if(count($tasks) > 0)    
        <table class="users-table">
            <tr>
                <th>Id</th>
                <th>Task</th>
                <th>Priority</th>
                <th>Owner</th>
                <th>Deadline</th>
            </tr>
        @foreach($tasks as $task)
        <tr style="cursor:pointer" onclick="window.location.href='/tasks/{{$task->id}}'">
                <td>{{$task->id}}</td>
                <td class="blue-table"><div class="task-table-text">{{$task->title}} <br><small style="color:#6B6F82">{{str_limit($task->description, 40)}}</small></div> </td>
                @if($task->priority == 0)
                    <td ><span style="color:white; background:#1E9FF2; padding:3px;border-radius:4px">Low</span></td>
                @elseif($task->priority == 1)
                    <td><span  style="color:white; background:#666EE8;padding:3px;border-radius:4px">Medium</span></td>
                @elseif($task->priority == 2)
                    <td><span style="color:white; background:#FF9149;padding:3px;border-radius:4px">High</span></td>
                @elseif($task->priority == 3)
                    <td><span style="color:white; background:#FF4961;padding:3px;border-radius:4px">Critical</span></td>
                @endif
                @foreach($users as $user)
                    @if($user->id == $task->user_id)
                        <td style="text-align:center"> <img class="profile-picture" src="http://www.clker.com/cliparts/B/R/Y/m/P/e/blank-profile-md.png" alt=""><br><small>{{$user->name}}</small></td>
                    @endif
                @endforeach
                    @if((time() - strtotime($task->deadline)) > 0)
                        <td style="color:red">{{$task->deadline}}</td>
                    @else
                        <td>{{$task->deadline}}</td>
                    @endif
        </tr>            
        @endforeach
        </table>
        {!! $tasks->appends(Input::except('page'))->render() !!}
    @else
        <p>No tasks found</p>
    @endif
@endsection