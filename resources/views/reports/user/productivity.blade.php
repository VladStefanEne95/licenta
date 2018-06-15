@extends('layouts.app')
@section('content')
    <?php
    $data = [];
    $day = [];
    foreach($rescue as $aux) {
         array_push($data,$aux); 
         array_push($day,$aux->day); 
    }
    
    ?>

    <h1>Productivity</h1>
<button id="procent">Procent</button>
<button id="hours">Hours</button>

<br>
<button id="month">Month</button>
<button id="week">Week</button>
<button id="day">Day</button>
<br>
Filter:
<input style="width:200px" type="text" name="daterange" />
    <canvas id="myChart"></canvas>
@endsection


@section('script')
<?php
$js_array = json_encode($data);
$js_array2 = json_encode($day);
echo "<script>let data = ". $js_array . ";\nlet days = ". $js_array2 . ";\n</script>"
?>


<script>
  $(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'bottom',
    autoUpdateInput: false
  }, function(start, end, label) {
    $('input[name="daterange"]').val(start.format('YYYY-MM-DD') + '  ' + end.format('YYYY-MM-DD')); 
    auxData = [];
    auxDays = [];
    let date1 = start.format('YYYY-MM-DD');
    let date2 = end.format('YYYY-MM-DD');
    if(! (date1 && date2)) {
      toastr.error('You need to select both the begin date and end date');
    } else if(date2 < date1) {
      toastr.error('End Date should be bigger than start date');
    } else {
      let startDate = new Date(date1);
      let endDate = new Date(date2);
      for(let i = 0; i < data.length; i++) {
        let d = new Date(days[i]);
        if (d >= startDate && d <= endDate) {
          auxData.push(data[i]['procent_productivity']);
          auxDays.push(days[i]);
        }
      }
      if (viewMode == 0)
        showDay(auxData,auxDays);
      else if (viewMode == 1)
        showWeek(auxData,auxDays);
      else if (viewMode == 2)
        showMonth(auxData,auxDays);
    }
  });
});
  let auxData = [], auxDays = days;
  let chartType = 0;
  for(let i = 0; i < data.length; i++)
    auxData[i] = data[i]['procent_productivity'];
  $('#submitFilter').click(function(){
    auxData = [];
    auxDays = [];
    let date1 = $('#datepicker').val();
    let date2 = $('#datepicker2').val();
    if(! (date1 && date2)) {
      toastr.error('You need to select both the begin date and end date');
    } else if(date2 < date1) {
      toastr.error('End Date should be bigger than start date');
    } else {
      let startDate = new Date(date1);
      let endDate = new Date(date2);
      for(let i = 0; i < data.length; i++) {
        let d = new Date(days[i]);
        if (d >= startDate && d <= endDate) {
          auxData.push(data[i]['procent_productivity']);
          auxDays.push(days[i]);
        }
      }
      if (viewMode == 0)
        showDay(auxData,auxDays);
      else if (viewMode == 1)
        showWeek(auxData,auxDays);
      else if (viewMode == 2)
        showMonth(auxData,auxDays);
    }
  })
  function getWeekNumber(d) {
    d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
    d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay()||7));
    var yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
    var weekNo = Math.ceil(( ( (d - yearStart) / 86400000) + 1)/7);
    return weekNo;
}
$( function() {
    $( "#datepicker" ).datepicker();
  } );
  $( function() {
    $( "#datepicker2" ).datepicker();
  } );


let d;
let dayName;
let viewMode = 0;
let label = 'Procentual productivity';

function showMonth(data, days){
  myChart.destroy();
  viewMode = 2;
  let monthData = {};
  let monthList = [];
  let monthCounter = {};
  for(let i = 0; i < days.length; i++ ) {
    d = new Date(days[i]);
    monthName = d.toString().split(' ')[1];
    if(!monthList.includes(monthName))
      monthList.push(monthName);
    
    if(monthData[monthName]) {
      monthData[monthName] += data[i];
      monthCounter[monthName]++;
    }
    else {
      monthData[monthName] = data[i];
      monthCounter[monthName] = 1;
    }
  }

let monthDataResult = [];

for(let i = 0; i < monthList.length; i++)
  monthDataResult[i] = (monthData[monthList[i]]/monthCounter[monthList[i]]).toFixed(2);

  myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: monthList,
      datasets: [{
        label: label,
        fill: false,
        borderColor: 'blue',
        data: monthDataResult
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
}

function showWeek(data, days){
  myChart.destroy();
  viewMode = 1;
  let weekData = [];
  let weekList = [];
  let weekCounter = [];
  for(let i = 0; i < days.length; i++ ) {
    d = new Date(days[i]);
    dayWeek = getWeekNumber(d);
    if(!weekList.includes(dayWeek))
      weekList.push(dayWeek);
    
    if(weekData[dayWeek]) {
      weekData[dayWeek] += data[i];
      weekCounter[dayWeek]++;
    }
    else {
      weekData[dayWeek] = data[i];
      weekCounter[dayWeek] = 1;
    }
  }
  weekData = weekData.filter(function(n){ return n != undefined });
  weekCounter = weekCounter.filter(function(n){ return n != undefined });
  
  for(let i = 0; i < weekData.length; i++)
    weekData[i] = (weekData[i]/weekCounter[i]).toFixed(2);

  
  myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: weekList,
      datasets: [{
        label: label,
        fill: false,
        borderColor: 'blue',
        data: weekData
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
}

function showDay(data, days) {
  myChart.destroy();
  viewMode = 0;
  myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: days,
      datasets: [{
        label: label,
        data: data,
        borderColor: 'blue',
        fill: false
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
}

$('#day').click(function(){
  showDay(auxData, auxDays);
})

$('#week').click(function(){
  showWeek(auxData, auxDays)
})

$('#month').click(function(){
  showMonth(auxData, auxDays);
})

$('#procent').click(function(){
  chartType = 0;
  for(let i = 0; i < data.length; i++)
    auxData[i] = data[i]['procent_productivity'];
    if (viewMode == 0)
      showDay(auxData,auxDays);
    else if (viewMode == 1)
      showWeek(auxData,auxDays);
    else if (viewMode == 2)
      showMonth(auxData,auxDays);
})

$('#hours').click(function(){
  chartType = 1;
  label = "Poductive hours";
  for(let i = 0; i < data.length; i++)
    auxData[i] = data[i]['productivity'];
    if (viewMode == 0)
       showDay(auxData,auxDays);
     else if (viewMode == 1)
      showWeek(auxData,auxDays);
    else if (viewMode == 2)
      showMonth(auxData,auxDays);
})


let ctx = document.getElementById('myChart').getContext('2d');
let myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: auxDays,
      datasets: [{
        label: label,
        fill: false,
        borderColor: 'blue',
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
