@extends('masterlayout.adminlayout')

@section('content')
<html lang="en">
  <head>
    <title>Google Pie Chart | LaravelCode</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
<style type="text/css">
table{
  margin-top: 20px;
}

th, td {
  padding: 15px;
}
</style>
  <body>
<div >
<label style="font-size:20px"><b>My Expenses </b></label>
<label style="float:right;">Dashboard</label> 

<table>
    <tr>
      <th>Expense Categories</th>
      <th >Total</th>
    </tr>

    @foreach($category as $cat)
    <tr>
      <td>{{$cat->category->name}}</td>
      <td>${{$cat->total_amount}}</td>
    </tr>

    @endforeach

</table>
</div>
    <div class="container p-5">
        
      

        <div id="piechart" style="width: 900px; height: 500px; margin-top: -20px; "></div>
    
    </div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Category', 'Total'],

                @php

                foreach($category as $cat1) {
                  

                    echo "['".$cat1->category->name."', ".$cat1->total_amount."],";
                }
                @endphp
        ]);

          var options = {
           
            is3D: false,
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart'));

          chart.draw(data, options);
        }
      </script>
</body>
</html>     


@endsection