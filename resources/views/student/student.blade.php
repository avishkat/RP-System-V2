@extends('layouts.sketchstud')
@section('content')

<script type="text/javascript">
    var analytics = <?php echo $area ?? ''; ?>

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
            <h1 class="m-2 text-dark"><strong>Dashboard</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div>
          
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <?php
        // $projects = DB::table('projects')->orderBy('id', 'desc')->take(5)->get();
        $projects = DB::connection(session('database'))->select('select * from projects order by created_at desc limit 5');
    ?>
    
    <div class="container">
          

        <div class="row mb-10">
        <div class="col-sm-6">
            <h5 class="m-2 text-dark"><strong>Analytics</strong></h5>
          </div><!-- /.col -->
          <div align="center" id="pie_chart" style="width:1500px; height:300px"></div>
        </div>
        <br>

        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-2 text-dark"><strong>Latest Projects</strong></h5>
          </div><!-- /.col -->
          <div class="col-sm-6" align="right">
            <p class="m-2 text-dark"><a href="/student/projects/">More>></a></p>
          </div><!-- /.col -->          
        </div><!-- /.row -->
        <div class="row marketing">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Temporary ID</th>
                <th>Title</th>
                <th>Research Area</th>
                <th>Supervisor</th>
                <th>Bids</th>
            </tr>
            @if(count($projects))
                @foreach($projects as $project)
                <?php
                  $supervisor = DB::table('users')->select('id')->where('name', $project->supervisor)->first();
                  $area = DB::table('research_areas')->select('id')->where('title', $project->area)->first();
                ?>
                        <tr>
                            <td><a href="/student/projects/{{ $project->id }}">{{ $project->tempid }}</a></td>
                            <td>{{ $project->title }}</td>
                            <td><a href="/student/projects/area/{{ $area->id }}">{{ $project->area }}</a></td>
                            <td><a href="/student/projects/supervisor/{{ $supervisor->id }}">{{ $project->supervisor }}</a></td>
                            <td>{{ $project->bids }}</td>
                        </tr>
                @endforeach
            @else
            <tr><td colspan="3">No Projects Found</td></tr>
            @endif
        </table>
        </div>
    </div>
    <br><br>

</section>
<!-- /.main content -->

@endsection

