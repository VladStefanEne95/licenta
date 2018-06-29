@extends('layouts.app')

@section('content')
<h2>Hi {{ Auth::user()->name }}, welcome back</h2>

<div class="square-list">
<canvas class="small-card" id="myChart"></canvas>
<div class="small-card">Info</div>
<div class="small-card">Info</div>
<div class="graph home-zone">
    <div style="height:200px;" class="graph-full">
        Graphs
    </div>
</div>
</div>

        <div style="height:200px;" class="card-half">
            Tasks:
        </div>
        <div style="height:200px;" class="card-half">
                Projects:
            </div>        


@endsection


@section('script')
<script>
    <?php
$js_array = json_encode($data);
echo "<script>let data = ". $js_array . ";\nlet days = ". $js_array2 . ";\n</script>"
?>
let ctx = document.getElementById('myChart').getContext('2d');
let myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: auxDays,
      datasets: [{
        fill: false,
        borderColor: '#3cba9f',
        data: auxData
      }]
    },

    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
  });
</script>
        @endsection