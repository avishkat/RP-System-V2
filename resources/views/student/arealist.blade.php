@extends('layouts.sketchstud')

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
            <h1 class="m-2 text-dark"><strong>Research Areas</strong></h1>
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
                <th>ID</th>
                <th>Research Area</th>
            </tr>
            @if(count($areas))
                @foreach($areas as $area)
                    <tr data-href="{{ url('/student/projects/area', $area->id) }}">
                        <td>{{ $area->id }}</td>
                        <td>{{ $area->title }}</td>
                    </tr>
                @endforeach
            @else
            <tr><td colspan="3">No Research Areas Found</td></tr>
            @endif
        </table>
        </div>
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

