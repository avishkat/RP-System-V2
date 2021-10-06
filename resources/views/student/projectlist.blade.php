@extends('layouts.sketchstud')

<style>
  tr{
    cursor: pointer;
  }
</style>

@section('content')

<!-- Content Header (Page header) -->

<?php
    $supervisor = "";
?>

@foreach($projects as $project)
<?php
    $supervisor = $project->supervisor;
?> 
@endforeach

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $supervisor }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="container-fluid">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Temporary ID</th>
                <th>Title</th>
                <th>Research Area</th>
                <th>Co-Supervisor</th>
                <th>Bids</th>
                <th>Status</th>
            </tr>
            @if(count($projects))
                @foreach($projects as $project)
                  <tr data-href="{{ route('student.projects.show', $project->id) }}">
                    <td>{{ $project->tempid }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->area }}</td>
                    <td>{{ $project->cosupervisor }}</td>
                    <td>{{ $project->bids }}</td>
                    <td>{{ $project->status }}</td>
                  </tr>
                @endforeach
            @else
            <tr><td colspan="3">No Projects Found</td></tr>
            @endif
        </table>
    </div>

<!-- /.main content -->

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