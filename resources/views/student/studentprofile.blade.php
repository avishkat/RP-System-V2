<!-- Sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
            <h1 class="m-0 text-dark"><strong>Student Profile</strong></h1>
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <?php
      $groups = DB::connection(session('database'))->table('research_groups')->where('member1', Auth::user()->name)->orWhere('member2', Auth::user()->name)->orWhere('member3', Auth::user()->name)->orWhere('member4', Auth::user()->name)->get();
    ?>
    <section class="content">
      <div class="container-fluid">

    @if(count($groups))
      @foreach($groups as $group)
          <!--Table for Research Group Members-->
          <div>
            <table class="table">
              <thead class="thead-dark" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <tr>
                  <th>+ Research Group</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="collapse" id="collapseExample">
                <tr>
                  <td>{{ $group->reg1 }}</td>
                  <td>{{ $group->reg2 }}</td>
                  <td>{{ $group->reg3 }}</td>
                  <td>{{ $group->reg4 }}</td>
                </tr>
                <tr>
                  <td>{{ $group->member1 }}</td>
                  <td>{{ $group->member2 }}</td>
                  <td>{{ $group->member3 }}</td>
                  <td>{{ $group->member4 }}</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!--Table for Accepted Research Project-->
          <?php
            $finalizedprojects = DB::connection(session('database'))->table('finalized_projects')->where('groupid', $group->groupid)->get();
          ?>
          @if(count($finalizedprojects))
            <div>
              <table class="table">
                <thead class="thead-dark" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                  <tr>
                    <th>+ My Project</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody class="collapse" id="collapseExample2">
                  <tr>
                    <th>Project ID</th>
                    <th>Topic</th>
                    <th>Supervisor</th>
                    <th>Co-Supervisor</th>
                  </tr>

                  @foreach($finalizedprojects as $finalizedproject)
                    <?php
                      $id = DB::connection(session('database'))->table('projects')->select('id')->where('title', $finalizedproject->topic)->where('supervisor', $finalizedproject->supervisor)->first();
                    ?>
                          
                    <tr data-href="{{ route('student.projects.show', $id->id) }}">
                      <td>{{ $finalizedproject->projectid }}</td>
                      <td>{{ $finalizedproject->topic }}</td>
                      <td>{{ $finalizedproject->supervisor }}</td>
                      <td>{{ $finalizedproject->cosupervisor }}</td>
                    </tr>
                  @endforeach
                      </tbody>
                    </table>
                  </div>

          @else
            <?php
              $bids = DB::connection(session('database'))->table('project__bids')->where('groupid', $group->groupid)->get();
            ?>

            <div>
              <table class="table">
                <thead class="thead-dark" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                  <tr>
                    <th>+ Voted Projects</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody class="collapse" id="collapseExample2">
                  <tr>
                    <th>Preference</th>
                    <th>Project ID</th>
                    <th>Supervisor</th>
                    <th>Status</th>
                  </tr>

                  @if(count($bids))
                    @foreach($bids as $bid)
                      <?php
                        $id = DB::connection(session('database'))->table('projects')->select('id')->where('tempid', $bid->researchid)->first();
                      ?>

                      <tr data-href="{{ route('student.projects.show', $id->id) }}">
                        <td>{{ $bid->preference }}</td>
                        <td>{{ $bid->researchid }}</td>
                        <td>{{ $bid->supervisor }}</td>
                        <td>{{ $bid->status }}</td>
                      </tr>
                    @endforeach
                  @endif
                      </tbody>
                    </table>
                  </div>
          @endif
      @endforeach    
    @else
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h4>Group Registration</h4>
                </div>
                <input type="hidden"></input>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('student.researchgroups.create') }}" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
    @endif
          
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

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

