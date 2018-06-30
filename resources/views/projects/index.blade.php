@extends('layouts.app')

@section('content')
    <h1>Projects</h1>
    @if(count($projects) > 0)
        <table class="users-table">
                <tr>
                    <th>Id</th>
                    <th>Project</th>
                    <th>Owner</th>
                    <th>Users</th>
                    <th>Deadline</th>
                </tr>

                @foreach($projects as $project)
                <?php
                $project->description = str_limit(strip_tags($project->description), 40);
                ?>
            <tr style="cursor:pointer" onclick="window.location.href='/projects/{{$project->id}}'">
                    <td>{{$project->id}}</td>
                    <td class="blue-table"><div class="task-table-text">{{$project->name}} <br><small style="color:#6B6F82">{!!$project->description!!}</small></div> </td>
                            <td style="text-align:center"> <img class="profile-picture" src="http://www.clker.com/cliparts/B/R/Y/m/P/e/blank-profile-md.png" alt=""><br><small>{{$project->owner}}</small></td>
                        <td style="text-align:center"><?php 
                        $myArray = explode(',', $project->users);
                        $myArray = str_replace("[", "",$myArray);
                        $myArray = str_replace("]", "",$myArray);
                        $myArray = str_replace('"', "",$myArray);
                        for($i = 0; $i < count($myArray); $i++) {
                            echo "<div style='display:inline-block; margin-left:5px;margin-right:5px;'> <img class='profile-picture' src='http://www.clker.com/cliparts/B/R/Y/m/P/e/blank-profile-md.png' alt=''><br> $myArray[$i]</div>";
                        }
                        ?></td>
                            @if((time() - strtotime($project->deadline)) > 0)
                            <td style="color:red">{{$project->deadline}}</td>
                        @else
                            <td>{{$project->deadline}}</td>
                        @endif
            </tr>            
         
        @endforeach
        </table>
    @else
        <p>No projects</p>
    @endif
@endsection