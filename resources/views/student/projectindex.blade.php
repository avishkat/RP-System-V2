@extends('layouts.sketchstud')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-2 text-dark"><strong>Project Availability</strong></h1>
          </div><!-- /.col -->

          <div class="col-sm-6">
          <form>
            <div class="input-group mb-3">
                <select name="sortby" id="sortby" class="form-control input-sm dynamic" >
                    <option value="supervisor">Sort By</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="area">Research Area</option>
                </select>
                    
                <div class="input-group-append">
                    <input type="submit" class="btn btn-default" value="Sort">
                </div>
            </div>
          </form>
          </div>
          
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <?php
        $supervisors = DB::connection(session('database'))->table('projects')->select('supervisor')->groupBy('supervisor')->orderBy('supervisor')->get();
    ?>
    
    <div class="container">
        <div class="row marketing">
            @foreach($supervisors as $supervisor)
                <div class="col-lg-4">
        
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h5><strong>{{ $supervisor->supervisor }}</strong></h5>

                        <?php
                            $projs = DB::connection(session('database'))->table('projects')->select('title')->where('supervisor', $supervisor->supervisor)->get();
                            $noprojs = 0;
                            if(count($projs)){
                                foreach($projs as $proj){
                                    $noprojs = $noprojs + 1;
                                }
                            }

                            $supid = DB::table('users')->select('id')->where('name', $supervisor->supervisor)->first();
                        ?>
                        
                            <p>{{ $noprojs }} Projects</p>
                        </div>
                        <a href="{{ url('/student/projects/supervisor', $supid->id) }}" class="small-box-footer">Projects <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                
                </div>
            @endforeach
        </div>
    </div>

</section>
<!-- /.main content -->

@endsection