@extends('layouts.sketchsup')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Projects</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <?php
        $numprojs = 0;
        $max = 0
    ?>
    @foreach($projects as $project)
        @if($project->supervisor == Auth::user()->name && $project->status == 'open' || $project->status == 'closed')
        <?php
            $numprojs = $numprojs + 1
        ?>
        @endif
    @endforeach

<?php
    $max = DB::table('constraints')->select('value')->where('id', 1)->first();
?>
    @if($numprojs < $max->value)
        <p>
            <a href="{{ route('supervisor.projects.create') }}" class="btn btn-primary">+ Add New Project</a>
        </p>
    @endif

        <table class="table table-bordered table-striped">
            <tr>
                <th>Temporary ID</th>
                <th>Title</th>
                <th>Research Area</th>
                <th>Supervisor</th>
                <th>Co-Supervisor</th>
                <th>Bids</th>
            </tr>
            @if(count($projects))
            @foreach($projects as $project)
                @if($project->status == 'Open')
                    <tr>
                        <td>{{ $project->tempid }}</td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->area }}</td>
                        <td>{{ $project->supervisor }}</td>
                        <td>{{ $project->cosupervisor }}</td>
                        <td>{{ $project->bids }}</td>
                    </tr>
                @endif
            @endforeach
            @else
            <tr><td colspan="3">No Projects Found</td></tr>
            @endif
        </table>
    </div>
</section>
<!-- /.main content -->

@endsection