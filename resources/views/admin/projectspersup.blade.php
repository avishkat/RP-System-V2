@extends('layouts.sketchadmin')

@section('content')

<?php
    $supervisor = "";
?>

@foreach($projects as $project)
    <?php
        $supervisor = $project->supervisor;
        $supervisorid = DB::table('supervisors')->where('name', $supervisor)->first(); 
    ?>
@endforeach

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{$supervisor}}</h1>
          </div><!-- /.col -->
            <div class="col-sm-6">
              
            </div><!-- /.col -->
          <div class="col-sm-6">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><br>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Project ID</th>
                <th>Title</th>
                <th>Area</th>
                <th>Co-Supervisor</th>
                <th>Status</th>
                <th>Group ID</th>
            </tr>
            @if(count($projects))
            @foreach($projects as $project)
            <tr>
                <?php
                    $finals = DB::connection($database)->table('finalized_projects')->where('topic', $project->title)->get(); 
                ?>
                @if(count($finals))
                    @foreach($finals as $final)
                      <td>{{ $final->projectid }}</td>
                    @endforeach
                @else
                    <td>{{ $project->tempid }}</td> 
                @endif
                  
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->area }}</td>
                    <td>{{ $project->cosupervisor }}</td>
                    <td>{{ $project->status }}</td>

                @if(count($finals))
                    @foreach($finals as $final)
                      <td>{{ $final->groupid }}</td>
                    @endforeach
                @else
                    <td>-</td>
                @endif
            </tr>
            @endforeach
            @else
                <tr><td colspan="3">No Projects Found</td></tr>
            @endif
           
        </table>
    </div>
</section>
<!-- /.main content -->

@endsection