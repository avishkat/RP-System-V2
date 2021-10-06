@extends('layouts.sketchsup')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><strong>Profile Setup</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form method="post" action="{{ route('supervisor.supervisors.store') }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Designation</label>
                    <div class="col-md-6">
                    <select name="designation" class="form-control">
                        <option>Designation</option>
                        <option value="Assisstant Lecturer">Assisstant Lecturer</option>
                        <option value="Lecturer">Lecturer</option>
                        <option value="Senior Lecturer">Senior Lecturer</option>
                        <option value="Assisstant Professor">Assisstant Professor</option>
                        <option value="Professor">Professor</option>
                    </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Email Address</label>
                    <div class="col-md-6">
                        <input type="email" name="email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Department</label>
                    <div class="col-md-6">
                    <select name="department" class="form-control">
                        <option>Department</option>
                        <option value="CS">CS</option>
                        <option value="CSNE">CSNE</option>
                        <option value="CSSE">CSSE</option>
                        <option value="DS">DS</option>
                        <option value="IM">IM</option>
                        <option value="ISE">ISE</option>
                        <option value="IT">IT</option>
                    </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Interest Areas</label>
                    <div class="col-md-6">
                        <input type="text" name="area" class="form-control" placeholder="Separate by commas">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">LinkedIn Profile</label>
                    <div class="col-md-6">
                        <input type="url" name="linkedin" class="form-control" placeholder="LinkedIn Profile">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Google Scholar Profile</label>
                    <div class="col-md-6">
                        <input type="url" name="scholar" class="form-control" placeholder="Google Scholar Profile">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Staff Profile</label>
                    <div class="col-md-6">
                        <input type="url" name="staff" class="form-control" placeholder="Staff Profile">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="name" class="form-control" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group d-flex flex-column">
                <div class="row">
                    <label class="col-md-3">Profile Image</label>
                    <div class="col-md-6">
                        <input type="file" name="image" onchange="previewFile(this)">
                        <img id="previewImg" height="150px">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            </fieldset>

            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Update">
            </div>
            <br><br>
        </form>
    </div>
</section>
<!-- /.main content -->

<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
        if(file)
        {
            var reader = new FileReader();
            reader.onload = function(){
                $('#previewImg').attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection