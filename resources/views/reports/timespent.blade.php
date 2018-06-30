@extends('layouts.app')
@section('content')

<canvas id="myChart"></canvas>

@endsection


@section('script')
<?php
$js_array = json_encode($result);
echo "<script>let data = ". $js_array . ";\n</script>"
?>


<script>
    let userNames = [], taskNames = [], estimated = [], real = [], id = [];
  for(let i = 0; i < data.length; i++) {
      userNames.push(data[i].userName);
      taskNames.push(data[i].taskName);
      estimated.push( ~~(data[i].estimatedTime));
      real.push(~~(data[i].realTime/60));
      id.push(data[i].taskId);
  }
  let ctx = document.getElementById("myChart").getContext('2d');
  let myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: taskNames,
        datasets: [{
          label: 'Estimated time(minutes)',
          data: estimated,
          backgroundColor: "rgba(153,255,51,1)"
        }, {
          label: 'Real time(minutes)',
          data: real,
          backgroundColor: "rgba(255,153,0,1)"
        }]
      }
    });

</script>
@endsection
