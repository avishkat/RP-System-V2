@extends('layouts.sketchstud')
@section('content')

<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
          </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->

<?php
  $groups = DB::connection($database)->table('research_groups')->get();
?>
@foreach($groups as $group)
  @if($group->member1 == Auth::user()->name || $group->member2 == Auth::user()->name || $group->member3 == Auth::user()->name || $group->member4 == Auth::user()->name)
    <?php
      $voted = DB::connection($database)->table('project__bids')->where('researchid', $project->tempid)->where('groupid', $group->groupid)->get();
      $acceptedthis = DB::connection($database)->table('finalized_projects')->where('groupid', $group->groupid)->where('topic', $project->title)->where('supervisor', $project->supervisor)->get();
      $acceptedany = DB::connection($database)->table('finalized_projects')->where('groupid', $group->groupid)->get();
    ?>
  @endif
@endforeach

<section class="content">
    <div class="container">
      <div class="jumbotron">
        <h1 align="center"><strong>{{ $project->title }}</strong></h1><br>
        @if($project->status == "Closed")
          <p align="center"><button class="btn btn-lg btn-success" disabled>Closed</button></p>
        @elseif(count($acceptedthis))
          <p align="center"><button class="btn btn-lg btn-success" disabled>Accepted</button></p>
        @elseif(count($acceptedany))
          <p align="center"><button class="btn btn-lg btn-success" disabled>BID</button></p>
        @elseif(count($voted))
          <p align="center"><button class="btn btn-lg btn-success" disabled>Bid Placed</button></p>
        @else
          @foreach($groups as $group)
            @if($group->member1 == Auth::user()->name)
              <p align="center"><a class="btn btn-lg btn-success" href="#" role="button" data-toggle="modal" data-target="#exampleModalCenter">BID</a></p>
            @endif
          @endforeach
        @endif
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <h5><strong>Research Area</strong></h5>
          <p>{{ $project->area }}</p>

          <h5><strong>Abstract</strong></h5>
          <p>{{ $project->abstract }}</p>

          <h5><strong>Keywords</strong></h5>
          <p>{{ $project->keywords }}</p>
        </div>

        <div class="col-lg-6">
          <h5><strong>References</strong></h5>
          <p>{{ $project->references }}</p>

          <h5><strong>Supervisor</strong></h5>
          <p>{{ $project->supervisor }}</p>

          <h5><strong>Co-Supervisor</strong></h5>
          <p>{{ $project->cosupervisor }}</p>
        </div>
      </div>


<?php
  $researchgroup = DB::connection($database)->table('research_groups')->where('member1', Auth::user()->name)->orWhere('member2', Auth::user()->name)->orWhere('member3', Auth::user()->name)->orWhere('member4', Auth::user()->name)->first();
  $preferences = DB::connection($database)->table('project__bids')->where('groupid', $researchgroup->groupid)->get();
  $prefarray = [];
?>

@foreach($preferences as $preference)
<?php
  array_push($prefarray, $preference->preference);

?>
@endforeach

      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">BID</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="{{ route('student.projectbids.store') }}" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              
                  <div class="form-group">
                    <label for="preference" class="col-form-label">Preference:</label>
                    <select name="preference" class="form-control input-sm dynamic">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>

                <div class="form-group">
                  <label for="qualification" class="col-form-label">Why are you interested in this project?</label>
                  <input type="file" name="qualification"></input>
                </div>
              
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="teamleader" class="form-control" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="projectid" class="form-control" value="{{ $project->tempid }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="supervisor" class="form-control" value="{{ $project->supervisor }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="area" class="form-control" value="{{ $project->area }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="form-group">
                  <input type="submit" class="btn btn-info" value="Submit">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</section>
<!-- /.main content -->

@endsection