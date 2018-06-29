@extends('layouts.app')
@section('content')

<h1 style="text-align:center">Time spent on work</h1>
<div class="btn-grup">
<h3>Change view mode</h3> 
<button id="month" class="btn-info">Month</button>
<button id="week" class="btn-info">Week</button>
<button id="day" class="btn-info">Day</button>
</div>
<div class="filter-date">
<h3>Choose date range</h3>
<input style="width:200px" type="text" name="daterange" />
</div>
<hr>

<canvas id="myChart"></canvas>

@endsection


@section('script')
<?php
$js_array = json_encode($result);
echo "<script>let server_data = ". $js_array . ";\n</script>"
?>


<script>
  let days = [], data = [];
  let d = new Date(server_data[0]['created_at']);
  days[0] = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + ( d.getDate()) ;
  data[0] = (server_data[0]['working_seconds']/3600);
   for(let i = 1, j = 0; i < server_data.length; i++) {
    d = new Date(server_data[i]['created_at']);
    if(( d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + ( d.getDate()) ) !=  days[j]) {
      j++;
      days[j] = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + ( d.getDate()) ;
      data[j] = server_data[i]['working_seconds']/3600;
    }
    else {
      data[j] += server_data[i]['working_seconds']/3600;
    }
  }
 



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
      console.log("aici");
      let startDate = new Date(date1);
      let endDate = new Date(date2);
      for(let i = 0; i < data.length; i++) {
        d = new Date(days[i]);
        if (d >= startDate && d <= endDate) {
          auxData.push(data[i]);
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
    auxData[i] = data[i];

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


let dayName;
let viewMode = 0;


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
    type: 'bar',
    data: {
      labels: monthList,
      datasets: [{
        label: "Working hours",
        fill: false,
        borderColor: 'blue',
        data: monthDataResult.map(function(each_element){
            return Number(each_element.toFixed(2));
      }),
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

    console.log(weekData);
  
  myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: weekList,
      datasets: [{
        label: "Working hours",
        fill: false,
        borderColor: 'blue',
        data: weekData.map(function(each_element){
            return Number(each_element.toFixed(2));
        }),
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
    type: 'bar',
    data: {
      labels: days,
      datasets: [{
        label: "Working hours",
        data: data.map(function(each_element){
            return Number(each_element.toFixed(2));
      }),
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




















let ctx = document.getElementById('myChart').getContext('2d');
let myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: days,
      datasets: [{
        label: "Working hours",
        fill: false,
        borderColor: 'blue',
        data: data.map(function(each_element){
            return Number(each_element.toFixed(2));
      })
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