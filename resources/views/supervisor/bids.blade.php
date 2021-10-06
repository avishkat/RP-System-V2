@extends('layouts.sketchsup')

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
            <h1 class="m-0 text-dark">Notifications</h1>
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
        $projectid = "";
    ?>

    <table class="table table-bordered table-striped">
        <tr>
            <th>Project ID</th>
            <th>Group ID</th>
            <th>Preference</th>
        </tr>

        <?php
          $bids = DB::connection($database)->table('project__bids')->where('supervisor', Auth::user()->name)->where('status', "Voted")->get();
        ?>

        @if(count($bids))
          @foreach($bids as $bid)
          <?php
            $finalized = DB::connection($database)->table('finalized_projects')->where('groupid', $bid->groupid)->get();
          ?>
          @if(count($finalized))

          @else
            <tr data-href="{{ route('supervisor.projectbids.show', $bid->id) }}">
              <td>{{ $bid->researchid }}</td>
              <td>{{ $bid->groupid }}</td>
              <td>{{ $bid->preference }}</td>
            </tr>
          @endif
          @endforeach  
        @else  
          <tr><td colspan="3">No Bids Found</td></tr>      
        @endif
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