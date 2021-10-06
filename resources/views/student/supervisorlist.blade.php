@extends('layouts.sketchstud')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-2 text-dark"><strong>Supervisors</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div>
          
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

    

<!-- Main content -->
<section class="content">
    
    <div class="container">
        <div class="row mb-2">
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-2 text-dark"></h5>
          </div><!-- /.col -->        
        </div><!-- /.row -->
        <div class="row marketing">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Name</th>
                <th>Designation</th>
                <th>Research Area</th>
                <th>Department</th>
            </tr>
            @if(count($supervisors))
                @foreach($supervisors as $supervisor)
                    <tr>
                        <td><a href="/student/supervisors/{{ $supervisor->id }}">{{ $supervisor->name }}</a></td>
                        <td>{{ $supervisor->designation }}</td>
                        <td>{{ $supervisor->area }}</td>
                        <td>{{ $supervisor->department }}</td>
                    </tr>
                @endforeach
            @else
            <tr><td colspan="3">No Supervisors Found</td></tr>
            @endif
        </table>
        </div>
    </div>

</section>
<!-- /.main content -->

@endsection

