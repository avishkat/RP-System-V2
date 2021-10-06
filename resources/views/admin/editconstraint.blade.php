@extends('layouts.sketchadmin')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Constraint</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form method="post" action="{{ route('admin.constraints.update', $constraint->id) }}">
        @method('PUT')
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Constraint</label>
                    <div class="col-md-6">
                        <input type="text" name="constraint" class="form-control" value="{{ $constraint->constraint }}">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Value</label>
                    <div class="col-md-6">
                        <input type="text" name="value" class="form-control" value="{{ $constraint->value }}">
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