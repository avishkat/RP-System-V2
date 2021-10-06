@extends('layouts.sketchadmin')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Research Area</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form method="post" action="{{ route('admin.researcharea.store') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Title</label>
                    <div class="col-md-6">
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Save">
            </div>
        </form>
    </div>
</section>
<!-- /.main content -->

@endsection