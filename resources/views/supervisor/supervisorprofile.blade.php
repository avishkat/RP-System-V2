<!-- Sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@extends('layouts.sketchsup')

<style>
  tr{
    cursor: pointer;
  }
</style>

@section('content')

<?php
  $supervisors = DB::table('supervisors')->where('name', Auth::user()->name)->get();
?>

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><strong>Supervisor Profile</strong></h1>
          </div><!-- /.col -->

          @if(count($supervisors))
            @foreach($supervisors as $supervisor)
              <div class="col-sm-6">
                <h6 style="float:right"><a href="{{ route('supervisor.supervisors.edit', $supervisor->id) }}">Update Profile</a></h6>
              </div><!-- /.col -->
              @endforeach
          @else
            <div class="col-sm-6">
              <h6 style="float:right"><a href="{{ route('supervisor.supervisors.create') }}">Set Profile</a></h6>
            </div><!-- /.col -->
          @endif
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <?php
      $supervisors = DB::table('supervisors')->get();
    ?>
    <section class="content">

    @foreach($supervisors as $supervisor)
      @if($supervisor->name == Auth::user()->name)
        <div class="container">
          <div class="row">
            <div class="col">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="{{ asset('images') }}/{{ $supervisor->image }}" alt="Image" height="250px" class="img-rounded img-responsive" />
                        </div>
                        <div class="col-sm-6">
                            <p>
                                <h3><b>{{ $supervisor->name }}</b></h3>
                                <h6>{{ $supervisor->designation }}</h6>
                                <h6>Department of {{ $supervisor->department }}</h6>
                                <h6>{{ $supervisor->email }}</h6>
                                <p>Linkedin Profile: <a href="{{ $supervisor->linkedin }}">{{ $supervisor->linkedin }}</a></p>
                                <p>Google Scholar Profile: <a href="{{ $supervisor->gscholar }}">{{ $supervisor->gscholar }}</a></p>
                                <p>Staff Profile: <a href="{{ $supervisor->staffprofile }}">{{ $supervisor->staffprofile }}</a></p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        <br>
        </div>
      @endif
    @endforeach

      <div class="container-fluid">

      <?php
        $projects = DB::connection(session('database'))->table('projects')->where('supervisor', Auth::user()->name)->get();
      ?>      
          
          <!--Table for my Research Projects-->
          <div>
            <table class="table">
              <thead class="thead-dark" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <tr>
                  <th>+ My Projects</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="collapse" id="collapseExample">
                <tr>
                  <th>Project ID</th>
                  <th>Project Title</th>
                  <th>Group ID</th>
                  <th>Status</th>
                </tr>
              @foreach($projects as $project)
                <tr data-href="{{ url('/supervisor/projectbids/'.$project->tempid) }}">

                  <?php
                    $finals = DB::connection(session('database'))->table('finalized_projects')->where('topic', $project->title)->get(); 
                  ?>
                  @if(count($finals))
                    @foreach($finals as $final)
                      <td>{{ $final->projectid }}</td>
                    @endforeach
                  @else
                    <td>{{ $project->tempid }}</td> 
                  @endif
                  
                  <td>{{ $project->title }}</td>

                  @if(count($finals))
                    @foreach($finals as $final)
                      <td>{{ $final->groupid }}</td>
                    @endforeach
                  @else
                  <td>-</td>
                  @endif

                  <td>{{ $project->status }}</td>
                </tr>
              @endforeach
              </tbody>
              
            </table>
          </div>

      <?php
        $projects = DB::connection(session('database'))->table('projects')->where('cosupervisor', Auth::user()->name)->get();
      ?>      
          
          <!--Table for my Research Projects-->
          <div>
            <table class="table">
              <thead class="thead-dark" data-toggle="collapse" href="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                <tr>
                  <th>+ Co-Supervising Projects</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="collapse" id="collapseExample1">
                <tr>
                  <th>Project ID</th>
                  <th>Project Title</th>
                  <th>Group ID</th>
                  <th>Status</th>
                </tr>
              @foreach($projects as $project)
                <tr>

                  <?php
                    $finals = DB::connection(session('database'))->table('finalized_projects')->where('topic', $project->title)->get(); 
                  ?>
                  @if(count($finals))
                    @foreach($finals as $final)
                      <td>{{ $final->projectid }}</td>
                    @endforeach
                  @else
                    <td>{{ $project->tempid }}</td> 
                  @endif
                  
                  <td>{{ $project->title }}</td>

                  @if(count($finals))
                    @foreach($finals as $final)
                      <td>{{ $final->groupid }}</td>
                    @endforeach
                  @else
                  <td>-</td>
                  @endif

                  <td>{{ $project->status }}</td>
                </tr>
              @endforeach
              </tbody>
              
            </table>
          </div>
          
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll("tr[data-href]");

    rows.forEach(row => {
      row.addEventListener("click", () => {
        window.location.href = row.dataset.href;
      });
    });
  });
</script>

@endsection

