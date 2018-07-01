@extends('layouts.app')
@section('content')

@if($result)
<h1>{{$result[0]->name}}</h1>
<table class="users-table">
    <tr>
        <th>Task name</th>
        <th>Early/late</th>
        <th>Number of days</th>
    </tr>
@foreach($result as $res)
    <tr>    
        <td> {{$res->task}}</td>
        <td >{{$res->late}}</td>
        <?php if($res->late == "Early")
           echo "<td class='blue-table'>{$res->diffrence}</td>";?>
        <?php if($res->late == "Late") 
           echo "<td style='color:red'>{$res->diffrence} </td>";
            ?>
    </tr>    
@endforeach  
@else
<h1>No tasks finished.</h1>
@endif
</table>
@endsection
