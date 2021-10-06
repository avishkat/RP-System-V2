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
    $max = DB::table('constraints')->select('value')->where('id', 1)->first();
?>
 

        <table class="table table-bordered table-striped">
            <tr>
                <th>Temporary ID</th>
                <th>Title</th>
                <th>Research Area</th>
                <th>Supervisor</th>
                <th>Co-Supervisor</th>
                <th>Bids</th>
            </tr>
           
        </table>
    </div>
</section>
<!-- /.main content -->

@endsection