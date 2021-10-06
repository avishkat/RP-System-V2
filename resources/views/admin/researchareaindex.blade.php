@extends('layouts.sketchadmin')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Research Areas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <p>
            <a href="{{ route('admin.researcharea.create') }}" class="btn btn-primary">+ Add Research Area</a>
        </p>
        <table class="table table-bordered table-striped">
            <tr>
                <th>Research Area</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($areas as $area)
            <tr>
                <td>{{ $area->title }}</td>
                <td>
                    <a href="{{ route('admin.researcharea.edit', $area->id) }}" class="btn btn-info">Edit</a>
                </td>
                <td>
                    <form action="{{ route('admin.researcharea.destroy', $area->id) }}" method="post">
                        @method('DELETE')
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-danger">Delete</a>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</section>
<!-- /.main content -->

@endsection