@extends('layouts.sketchsup')

@section('content')

<script type="text/javascript">
    var analytics = <?php echo $area; ?>

    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
      var data = google.visualization.arrayToDataTable(analytics);

      var options = {
        title: 'Interest in Research Areas Among Students'
      };

      var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));

      chart.draw(data, options);
    }
</script>

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <div class="row mb-10">
        <div class="col-sm-6">
            <h5 class="m-2 text-dark"><strong>Analytics</strong></h5>
          </div><!-- /.col -->
          <div align="center" id="pie_chart" style="width:1500px; height:300px"></div>
        </div>
        <br>
        

        
      </div><!-- /.container-fluid -->
            <br>
    </section>
    <!-- /.content -->
@endsection
