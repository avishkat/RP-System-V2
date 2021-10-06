@extends('layouts.sketchadmin')

<style>
  tr{
    cursor: pointer;
  }
</style>

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Supervisors</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Supervisor</th>
                <th>Published Projects</th>
                <th>Finalized Projects</th>
                <th>Co-Supervising Projects</th>
            </tr>
            @foreach($supervisors as $supervisor)
            <?php
                $projects = DB::connection($database)->table('projects')->where('supervisor', $supervisor->name)->groupBy('supervisor')->count();
                $final = DB::connection($database)->table('projects')->where('supervisor', $supervisor->name)->where('status', "Closed")->groupBy('supervisor')->count();
                $cosupervise = DB::connection($database)->table('finalized_projects')->where('cosupervisor', $supervisor->name)->groupBy('cosupervisor')->count();
            ?>

            <tr data-href="{{ route('admin.projects.show', $supervisor->id) }}">
                <td>{{ $supervisor->name }}</td>
                <td>{{ $projects }}</td>
                <td>{{ $final }}</td>
                <td>{{ $cosupervise }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</section>
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