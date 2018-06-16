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

    <h1 style="text-align:center">Overview</h1>
    <div class="btn-grup">
        <h3>Change view mode</h3> 
<button class="btn-primary" id="procent">Procent</button>
<button class="btn-primary" id="hours">Hours</button>
    </div>
<div class="filter-date">
    <h3>Choose date range</h3>
<input style="width:200px" type="text" name="daterange" />
</div>

<label style="margin-left:40px;"><h3>Compare with the company average</h3><input type="checkbox" name="compare" id="compare"></label>
    <canvas id="myChart"></canvas>
@endsection


@section('script')
<?php
$js_array = json_encode($data);
$js_array2 = json_encode($day);
$js_array3 = json_encode($all);
echo "<script>let data = ". $js_array . ";\nlet days = ". $js_array2 . ";\nlet all = ". $js_array3 . ";\n</script>"
?>


<script>
  let startDate = 0;
  let endDate = 0;
  let compare = 0;
  let auxProd = 0, auxSocial = 0, auxEnt = 0, auxTotal = 0, auxOther = 0;
  let totalProd = 0, totalSocial = 0, totalEnt = 0, totalTotal = 0, totalOther = 0; 
  let ctx = document.getElementById("myChart").getContext('2d');
  let chartType = 0;

  for(let i = 0; i < all.length; i++) {
    if(data[i]) {
        auxProd += data[i]['procent_productivity'];
        auxSocial += data[i]['procent_social_media'];
        auxEnt += data[i]['procent_entertainment'];
        auxTotal += 100;
    }

        totalProd += all[i]['procent_productivity'];
        totalSocial += all[i]['procent_social_media'];
        totalEnt += all[i]['procent_entertainment'];
        totalTotal += 100;
    }
    auxProd = (auxProd/auxTotal * 100).toFixed(2);
    auxSocial = (auxSocial/auxTotal * 100).toFixed(2);
    auxEnt = (auxEnt/auxTotal *100).toFixed(2);
    auxOther = (100 - auxProd - auxEnt - auxSocial).toFixed(2);

    totalProd = (totalProd/totalTotal * 100).toFixed(2);
    totalSocial = (totalSocial/totalTotal * 100).toFixed(2);
    totalEnt = (totalEnt/totalTotal *100).toFixed(2);
    totalOther = (100 - totalProd - totalEnt - totalSocial).toFixed(2);

    let myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ["Productivity", "Social Media", "Enterteinment", "Other"],
        datasets: [{
          backgroundColor: [
            "#2ecc71",
            "#3498db",
            "#95a5a6",
            "#9b59b6"
          ],
          data: [auxProd, auxSocial, auxEnt, auxOther]
        }]
      }
    });

  $(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'bottom',
    autoUpdateInput: false
  }, function(start, end, label) {
    $('input[name="daterange"]').val(start.format('YYYY-MM-DD') + '  ' + end.format('YYYY-MM-DD')); 
    auxProd = 0, auxSocial = 0, auxEnt = 0, auxTotal = 0, auxOther = 0;
    totalProd = 0, totalSocial = 0, totalEnt = 0, totalTotal = 0, totalOther = 0;
    let date1 = start.format('YYYY-MM-DD');
    let date2 = end.format('YYYY-MM-DD');
    if(! (date1 && date2)) {
      toastr.error('You need to select both the begin date and end date');
    } else if(date2 < date1) {
      toastr.error('End Date should be bigger than start date');
    } else {
      myChart.destroy();
      startDate = new Date(date1);
      endDate = new Date(date2);
      if(chartType == 0) {
        for(let i = 0; i < all.length; i++) {
          let d = new Date(days[i]);
          if (d >= startDate && d <= endDate) {
            if(data[i]) {
              auxProd += data[i]['procent_productivity'];
              auxSocial += data[i]['procent_social_media'];
              auxEnt += data[i]['procent_entertainment'];
              auxTotal += 100;
            }
            totalProd += all[i]['procent_productivity'];
            totalSocial += all[i]['procent_social_media'];
            totalEnt += all[i]['procent_entertainment'];
            totalTotal += 100;
          }
        }
        auxProd = (auxProd/auxTotal * 100).toFixed(2);
        auxSocial = (auxSocial/auxTotal * 100).toFixed(2);
        auxEnt = (auxEnt/auxTotal *100).toFixed(2);
        auxOther = (100 - auxProd - auxEnt - auxSocial).toFixed(2);

        totalProd = (totalProd/totalTotal * 100).toFixed(2);
        totalSocial = (totalSocial/totalTotal * 100).toFixed(2);
        totalEnt = (totalEnt/totalTotal *100).toFixed(2);
        totalOther = (100 - totalProd - totalEnt - totalSocial).toFixed(2);
      } else if (chartType == 1) {
        for(let i = 0; i < all.length; i++) {
          let d = new Date(days[i]);
          if (d >= startDate && d <= endDate) {
            if(data[i]) {
              auxProd += data[i]['productivity'];
              auxSocial += data[i]['social_media'];
              auxEnt += data[i]['entertainment'];
              auxTotal += data[i]['time_pc'];
            }
            totalProd += all[i]['productivity'];
            totalSocial += all[i]['social_media'];
            totalEnt += all[i]['entertainment'];
            totalTotal += all[i]['time_pc'];
          }
        }
        auxProd = (auxProd).toFixed(2);
        auxSocial = (auxSocial).toFixed(2);
        auxEnt = (auxEnt).toFixed(2);
        auxOther = (auxTotal - auxProd - auxEnt - auxSocial).toFixed(2);


        totalProd = (totalProd).toFixed(2);
        totalSocial = (totalSocial).toFixed(2);
        totalEnt = (totalEnt).toFixed(2);
        totalOther = (totalTotal - totalProd - totalEnt - totalSocial).toFixed(2);
      }
    }
    if(compare == 0){
      myChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ["Productivity", "Social Media", "Enterteinment", "Other"],
          datasets: [{
            backgroundColor: [
              "#2ecc71",
              "#3498db",
              "#95a5a6",
              "#9b59b6"
            ],
            data: [auxProd, auxSocial, auxEnt, auxOther]
          }]
        }
      });
    }
    else if(compare == 1) {
      showCompare();
    }
  });
});
$('#hours').click(function(){
  chartType = 1;
  auxProd = 0, auxSocial = 0, auxEnt = 0, auxTotal = 0, auxOther = 0; 
  totalProd = 0, totalSocial = 0, totalEnt = 0, totalTotal = 0, totalOther = 0;
  myChart.destroy();
  for(let i = 0; i < all.length; i++) {
          let d = new Date(days[i]);
          if (d >= startDate && d <= endDate && startDate && endDate) {
            if(data[i]) {
              auxProd += data[i]['productivity'];
              auxSocial += data[i]['social_media'];
              auxEnt += data[i]['entertainment'];
              auxTotal += data[i]['time_pc'];
            }

            totalProd += all[i]['productivity'];
            totalSocial += all[i]['social_media'];
            totalEnt += all[i]['entertainment'];
            totalTotal += all[i]['time_pc'];
          } else if(!startDate && !endDate) {
            if(data[i]) {
              auxProd += data[i]['productivity'];
              auxSocial += data[i]['social_media'];
              auxEnt += data[i]['entertainment'];
              auxTotal += data[i]['time_pc'];
            }
            totalProd += all[i]['productivity'];
            totalSocial += all[i]['social_media'];
            totalEnt += all[i]['entertainment'];
            totalTotal += all[i]['time_pc'];
          }
        }
        auxProd = (auxProd).toFixed(2);
        auxSocial = (auxSocial).toFixed(2);
        auxEnt = (auxEnt).toFixed(2);
        auxOther = (auxTotal - auxProd - auxEnt - auxSocial).toFixed(2);

        console.log(totalProd);

        totalProd = (totalProd).toFixed(2);
        totalSocial = (totalSocial).toFixed(2);
        totalEnt = (totalEnt).toFixed(2);
        totalOther = (totalTotal - totalProd - totalEnt - totalSocial).toFixed(2);
       if(compare == 0) {
          myChart = new Chart(ctx, {
            type: 'pie',
            data: {
              labels: ["Productivity", "Social Media", "Enterteinment", "Other"],
              datasets: [{
                backgroundColor: [
                  "#2ecc71",
                  "#3498db",
                  "#95a5a6",
                  "#9b59b6"
                ],
                data: [auxProd, auxSocial, auxEnt, auxOther]
              }]
            }
          });
        } else if (compare == 1) {
          showCompare();
        }
})

$('#procent').click(function(){
  chartType = 0;
  auxProd = 0, auxSocial = 0, auxEnt = 0, auxTotal = 0, auxOther = 0; 
  totalProd = 0, totalSocial = 0, totalEnt = 0, totalTotal = 0, totalOther = 0;
  myChart.destroy();
  for(let i = 0; i < all.length; i++) {
      let d = new Date(days[i]);
      if (d >= startDate && d <= endDate && startDate && endDate) {
        if(data[i]) {
          auxProd += data[i]['procent_productivity'];
          auxSocial += data[i]['procent_social_media'];
          auxEnt += data[i]['procent_entertainment'];
          auxTotal += 100;
        }

          totalProd += all[i]['procent_productivity'];
          totalSocial += all[i]['procent_social_media'];
          totalEnt += all[i]['procent_entertainment'];
          totalTotal += 100;
        } else if(!startDate && !endDate) {
          if(data[i]) {
            auxProd += data[i]['procent_productivity'];
            auxSocial += data[i]['procent_social_media'];
            auxEnt += data[i]['procent_entertainment'];
            auxTotal += 100;
          }

          totalProd += all[i]['procent_productivity'];
          totalSocial += all[i]['procent_social_media'];
          totalEnt += all[i]['procent_entertainment'];
          totalTotal += 100;
        }
      }

      auxProd = (auxProd/auxTotal * 100).toFixed(2);
      auxSocial = (auxSocial/auxTotal * 100).toFixed(2);
      auxEnt = (auxEnt/auxTotal *100).toFixed(2);
      auxOther = (100 - auxProd - auxEnt - auxSocial).toFixed(2);

      totalProd = (totalProd/totalTotal * 100).toFixed(2);
      totalSocial = (totalSocial/totalTotal * 100).toFixed(2);
      totalEnt = (totalEnt/totalTotal * 100).toFixed(2);
      totalOther = (100 - totalProd - totalEnt - totalSocial).toFixed(2);
      if (compare == 0) {
        myChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ["Productivity", "Social Media", "Enterteinment", "Other"],
            datasets: [{
              backgroundColor: [
                "#2ecc71",
                "#3498db",
                "#95a5a6",
                "#9b59b6"
              ],
              data: [auxProd, auxSocial, auxEnt, auxOther]
            }]
          }
        });
      } else if (compare == 1) {
        showCompare();
      }
})

$('#compare').click(function() {
    myChart.destroy();
    if(this.checked) {
      showCompare();
      compare = 1;
    }
    else {
      compare = 0;
      myChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ["Productivity", "Social Media", "Enterteinment", "Other"],
            datasets: [{
              backgroundColor: [
                "#2ecc71",
                "#3498db",
                "#95a5a6",
                "#9b59b6"
              ],
              data: [auxProd, auxSocial, auxEnt, auxOther]
            }]
          }
        });
    }
});

function showCompare() {
      myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Productivity", "Social Media", "Enterteinment", "Other"],
        datasets: [{
          label: 'Angajat',
          data: [auxProd, auxSocial, auxEnt, auxOther],
          backgroundColor: "rgba(153,255,51,1)"
        }, {
          label: 'Media',
          data: [totalProd, totalSocial, totalEnt, totalOther],
          backgroundColor: "rgba(255,153,0,1)"
        }]
      }
    });
}
</script>
@endsection