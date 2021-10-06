@extends('layouts.sketchsup')
@section('content')

<!-- Content Header (Page header) -->

<?php
    $projectname = DB::connection($database)->table('projects')->select('title')->where('tempid', $bid->researchid)->first();
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-2 text-dark"><strong></strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div>
          
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="container">

    <div class="row marketing">
        <div class="col-lg-10">

            <div class="row">
                <div class="col-lg-2">
                    <h5><strong>Project Name: </strong></h5>
                </div>

                <div class="col-lg-8">
                    <h5>{{ $projectname->title }}</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <h5><strong>Group ID: </strong></h5>
                </div>

                <div class="col-lg-8">
                    <h5>{{ $bid->groupid }}</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <h5><strong>Preference: </strong></h5>
                </div>

                <div class="col-lg-8">
                    <h5>{{ $bid->preference }}</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <h5><strong>Motivation: </strong></h5>
                </div>

                <div class="col-lg-8">
                    <p>
                        <a href="{{ url('storage/'.$bid->qualifications) }}">{{ $bid->qualifications }}</a>
                    </p>
                </div>
            </div>
          
        </div>

        <div class="col" style="align: right">
            <form method="post" action="{{ route('supervisor.projectbids.update', $bid->id) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="status" value="Accepted">
                <input type="hidden" name="group" value="{{ $bid->groupid }}">
                <input type="hidden" name="project" value="{{ $bid->researchid }}">

                {{ method_field('PUT') }}
                <p style="float:right"><button class="btn btn-md btn-info">Accept</button></p>
            </form>
        </div>
        <div class="col" style="align: right">
            <p style="float:right"><button class="btn btn-md btn-danger" data-toggle="modal" data-target="#exampleModalCenter">Decline</button></p>
        </div>
    </div>
    <br>

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
                <form method="post" action="{{ route('supervisor.projectbids.update', $bid->id) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                  <label for="comment" class="col-form-label">Comments</label>
                  <textarea type="text" name="comment" class="form-control"></textarea>
                </div>
                
                <input type="hidden" name="status" value="Declined">
                <input type="hidden" name="group" value="{{ $bid->groupid }}">
                <input type="hidden" name="project" value="{{ $bid->researchid }}">

                <div class="form-group">
                    {{ method_field('PUT') }}
                    <input type="submit" class="btn btn-info" value="Send">
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>

    <?php
        $students = DB::connection($database)->table('research_groups')->where('groupid', $bid->groupid)->first();
    ?>

    <div class="row marketing">
        @if(!$students->member1 == null)
        <div class="col-lg-5">
            <div class="small-box bg-light">
            <div class="row">
                <div class="col-sm-3"  >
                    <img style="padding-left:10px; padding-top:10px" src="{{ asset('images') }}/{{ $students->image1 }}" alt="Image" height="100px" class="img-rounded img-responsive" />
                </div>
                <div class="col-sm-8">
                    <div class="inner" style="padding-left:10px; padding-top:10px">
                        <h5>{{ $students->member1 }}</h5>
                        <h5>{{ $students->reg1 }}</h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="inner" style="padding-left:20px; padding-top:6px">
                    <h6><strong>GPA:</strong> {{ $students->gpa1 }}</h6>
                    <h6><strong>Specialization:</strong> {{ $students->spec1 }}</h6>
                    <h6><strong>Email:</strong> {{ $students->email1 }}</h6>
                </div>
            </div>
            </div>
        </div>
        @else
        <div><h1>no stud</h1></div>
        @endif

        @if(!$students->member2 == null)
        <div class="col-lg-5">
            <div class="small-box bg-light">
            <div class="row">
                <div class="col-sm-3"  >
                    <img style="padding-left:10px; padding-top:10px" src="{{ asset('images') }}/{{ $students->image2 }}" alt="Image" height="100px" class="img-rounded img-responsive" />
                </div>
                <div class="col-sm-8">
                    <div class="inner" style="padding-left:10px; padding-top:10px">
                        <h5>{{ $students->member2 }}</h5>
                        <h5>{{ $students->reg2 }}</h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="inner" style="padding-left:20px; padding-top:6px">
                    <h6><strong>GPA: </strong>{{ $students->gpa2 }}</h6>
                    <h6><strong>Specialization: </strong>{{ $students->spec2 }}</h6>
                    <h6><strong>Email: </strong>{{ $students->email2 }}</h6>
                </div>
            </div>
            </div>
        </div>
        @endif
    </div>

    <div class="row marketing">
        @if(!$students->member3 == null)
        <div class="col-lg-5">
            <div class="small-box bg-light">
            <div class="row">
                <div class="col-sm-3"  >
                    <img style="padding-left:10px; padding-top:10px" src="{{ asset('images') }}/{{ $students->image3 }}" alt="Image" height="100px" class="img-rounded img-responsive" />
                </div>
                <div class="col-sm-8">
                    <div class="inner" style="padding-left:10px; padding-top:10px">
                        <h5>{{ $students->member3 }}</h5>
                        <h5>{{ $students->reg3 }}</h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="inner" style="padding-left:20px; padding-top:6px">
                    <h6><strong>GPA: </strong>{{ $students->gpa3 }}</h6>
                    <h6><strong>Specialization:</strong> {{ $students->spec3 }}</h6>
                    <h6><strong>Email:</strong> {{ $students->email3 }}</h6>
                </div>
            </div>
            </div>
        </div>
        @endif

        @if(!$students->member4 == null)
        <div class="col-lg-5">
            <div class="small-box bg-light">
            <div class="row">
                <div class="col-sm-3"  >
                    <img style="padding-left:10px; padding-top:10px" src="{{ asset('images') }}/{{ $students->image4 }}" alt="Image" height="100px" class="img-rounded img-responsive" />
                </div>
                <div class="col-sm-8">
                    <div class="inner" style="padding-left:10px; padding-top:10px">
                        <h5>{{ $students->member4 }}</h5>
                        <h5>{{ $students->reg4 }}</h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="inner" style="padding-left:20px; padding-top:6px">
                    <h6>GPA: {{ $students->gpa4 }}</h6>
                    <h6>Specialization: {{ $students->spec4 }}</h6>
                    <h6>Email: {{ $students->email4 }}</h6>
                </div>
            </div>
            </div>
        </div>
        @endif
    </div>

<br><br>
</div>

<!-- /.main content -->

@endsection

