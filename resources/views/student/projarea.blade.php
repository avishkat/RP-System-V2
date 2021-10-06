@extends('layouts.sketchstud')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-2 text-dark"><strong>Projects</strong></h1>
          </div><!-- /.col -->

          <div class="col-sm-6">
          <form action="filter" method="post">{{ csrf_field() }}
              <select class="form-control" name='slcrecom' onchange='this.form.submit()'>
                <option value="-">Sort By</option>
                <option value="0">Supervisors</option>
                <option value="1">Research Areas</option>
              </select>
              <noscript>
                  <input type="submit" value="Submit">
              </noscript>
            </form>
          </div>
          
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <?php
        $areas = DB::connection(session('database'))->table('projects')->select('area')->groupBy('area')->orderBy('area')->get();
    ?>
    
    <div class="container">
        <div class="row marketing">
            @foreach($areas as $area)
                <div class="col-lg-4">
        
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h5><strong>{{ $area->area }}</strong></h5>

                        <?php
                            $projs = DB::connection(session('database'))->table('projects')->select('title')->where('area', $area->area)->get();
                            $noprojs = 0;
                            if(count($projs)){
                                foreach($projs as $proj){
                                    $noprojs = $noprojs + 1;
                                }
                            }

                        ?>
                        <!-- problem! need to work on-->
                            <p>{{ $noprojs }} Projects</p>
                        </div>
                        <a href="/student/projects/supervisor/6" class="small-box-footer">Projects <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                
                </div>
            @endforeach
        </div>
    </div>

</section>
<!-- /.main content -->

@endsection