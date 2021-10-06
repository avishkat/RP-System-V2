@extends('layouts.sketchsup')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Project</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form method="post" action="{{ route('supervisor.projects.store') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Research Topic</label>
                    <div class="col-md-6">
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Research Area</label>
                    <!-- <div class="col-md-6">
                        <input type="text" name="area" class="form-control">
                    </div> -->
                    <div class="col-md-6">
                        <select name="area" class="form-control input-sm dynamic">
                            <option>Select a Research Area</option>
                            @foreach(App\ResearchArea::all() as $area)
                                <option value="{{$area->title}}">{{$area->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Abstract</label>
                    <div class="col-md-6">
                        <textarea name="abstract" class="form-control" id="abstract"></textarea>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Keywords</label>
                    <div class="col-md-6">
                        <input type="text" name="keywords" class="form-control" placeholder="Separate by commas">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">References</label>
                    <div class="col-md-6">
                        <input type="text" name="references" class="form-control">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Co-Supervisor</label>
                    <div class="col-md-6">
                        <select name="cosupervisor" class="form-control input-sm dynamic">
                        <option>Select a Co-Supervisor</option>
                        @foreach(App\User::all() as $user)
                            @if($user->hasRole('supervisor'))
                                <option value="{{$user->name}}">{{$user->name}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="supervisor" class="form-control" value="{{ Auth::user()->name }}">
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