@extends('layouts.sketchadmin')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Constraints</h1>
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
                <th>Constraint</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>
            @if(count($constraints))
            @foreach($constraints as $constraint)
                <tr>
                    <td>{{ $constraint->constraint }}</td>
                    <td>{{ $constraint->value }}</td>
                    <td>
                        <a href="{{ route('admin.constraints.edit', $constraint->id) }}" class="btn btn-info">Edit</a>
                    </td>
                </tr>
            @endforeach
            @else
            <tr><td colspan="3">No Constraints Found</td></tr>
            @endif
        </table>
    </div>
</section>
<!-- /.main content -->

@endsection