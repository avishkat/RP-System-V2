@extends('layouts.sketchstud')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-2 text-dark"><strong>{{ $supervisor->name }}</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div>
          
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

    

<!-- Main content -->
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
                                <h4>{{ $supervisor->name }}</h4>
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

<?php
    $histories = DB::table('research_histories')->where('supervisor', $supervisor->name)->get();
?>

    <div class="row marketing">
        <div class="col-sm-6">
            <h4 class="m-2 text-dark"><strong>Previous Work</strong></h4>
        </div><!-- /.col -->
        <table class="table table-bordered table-striped">
            <tr>
                <th>Year</th>
                <th>Area</th>
                <th>Topic</th>
                <th>Supporting Documents</th>
            </tr>
            @if(count($histories))
                @foreach($histories as $history)
                    <tr>
                        <td>{{ $history->year }}</td>
                        <td>{{ $history->area }}</td>
                        <td>{{ $history->topic }}</td>
                        <td><a href="{{ $history->topic }}">{{ $history->documents }}</a></td>
                    </tr>
                @endforeach
            @else
            <tr><td colspan="3">No History Found</td></tr>
            @endif
        </table>
    </div>

</div>

<!-- /.main content -->

@endsection

