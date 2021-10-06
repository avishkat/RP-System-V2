@extends('layouts.sketchstud')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><strong>Research Group Registration</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <form action="filter" method="post">{{ csrf_field() }}
              <select class="form-control" name='slcrecom' onchange='this.form.submit()'>
                <option value="-">Number of Group Members</option>
                <option value="0">1</option>
                <option value="1">2</option>
                <option value="2">3</option>
                <option value="3">4</option>
              </select>
              <noscript>
                  <input type="submit" value="Submit">
              </noscript>
            </form>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form method="post" action="{{ route('student.researchgroups.store') }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>
            <legend>Team Leader</legend>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Name</label>
                    <div class="col-md-6">
                        <input type="text" name="name1" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Registration Number</label>
                    <div class="col-md-6">
                        <input type="text" name="reg1" class="form-control" placeholder="IT Number" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Contact Number</label>
                    <div class="col-md-6">
                        <input type="text" name="phone1" class="form-control" placeholder="Contact Number" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Email Address</label>
                    <div class="col-md-6">
                        <input type="email" name="email1" class="form-control" placeholder="Email Address" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Specialization</label>
                    <div class="col-md-6">
                    <select name="area1" class="form-control input-sm dynamic">
                        <option>Specialization Area</option>
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
                    <label class="col-md-3">GPA</label>
                    <div class="col-md-6">
                        <input type="text" name="gpa1" class="form-control" placeholder="GPA" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group d-flex flex-column">
                <div class="row">
                    <label class="col-md-3">Profile Image</label>
                    <div class="col-md-6">
                        <input type="file" name="image1" onchange="previewFile(this)" required>
                        <img id="previewImg" height="150px">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            </fieldset>

            <fieldset>
            <legend>Member 2</legend>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Name</label>
                    <div class="col-md-6">
                        <input type="text" name="name2" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Registration Number</label>
                    <div class="col-md-6">
                        <input type="text" name="reg2" class="form-control" placeholder="IT Number" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Contact Number</label>
                    <div class="col-md-6">
                        <input type="text" name="phone2" class="form-control" placeholder="Contact Number" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Email Address</label>
                    <div class="col-md-6">
                        <input type="email" name="email2" class="form-control" placeholder="Email Address" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Specialization</label>
                    <div class="col-md-6">
                    <select name="area2" class="form-control input-sm dynamic">
                        <option>Specialization Area</option>
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
                    <label class="col-md-3">GPA</label>
                    <div class="col-md-6">
                        <input type="text" name="gpa2" class="form-control" placeholder="GPA" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group d-flex flex-column">
                <div class="row">
                    <label class="col-md-3">Profile Image</label>
                    <div class="col-md-6">
                        <input type="file" name="image2" onchange="previewFile2(this)" required>
                        <img id="previewImg2" height="150px">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            </fieldset>

            <fieldset>
            <legend>Member 3</legend>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Name</label>
                    <div class="col-md-6">
                        <input type="text" name="name3" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Registration Number</label>
                    <div class="col-md-6">
                        <input type="text" name="reg3" class="form-control" placeholder="IT Number" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Contact Number</label>
                    <div class="col-md-6">
                        <input type="text" name="phone3" class="form-control" placeholder="Contact Number" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Email Address</label>
                    <div class="col-md-6">
                        <input type="email" name="email3" class="form-control" placeholder="Email Address" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Specialization</label>
                    <div class="col-md-6">
                    <select name="area3" class="form-control input-sm dynamic">
                        <option>Specialization Area</option>
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
                    <label class="col-md-3">GPA</label>
                    <div class="col-md-6">
                        <input type="text" name="gpa3" class="form-control" placeholder="GPA" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group d-flex flex-column">
                <div class="row">
                    <label class="col-md-3">Profile Image</label>
                    <div class="col-md-6">
                        <input type="file" name="image3" onchange="previewFile3(this)" required>
                        <img id="previewImg3" height="150px">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            </fieldset>
            
            <fieldset>
            <legend>Member 4</legend>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Name</label>
                    <div class="col-md-6">
                        <input type="text" name="name4" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Registration Number</label>
                    <div class="col-md-6">
                        <input type="text" name="reg4" class="form-control" placeholder="IT Number" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Contact Number</label>
                    <div class="col-md-6">
                        <input type="text" name="phone4" class="form-control" placeholder="Contact Number" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Email Address</label>
                    <div class="col-md-6">
                        <input type="email" name="email4" class="form-control" placeholder="Email Address" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Specialization</label>
                    <div class="col-md-6">
                    <select name="area4" class="form-control input-sm dynamic">
                        <option>Specialization Area</option>
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
                    <label class="col-md-3">GPA</label>
                    <div class="col-md-6">
                        <input type="text" name="gpa4" class="form-control" placeholder="GPA" required>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group d-flex flex-column">
                <div class="row">
                    <label class="col-md-3">Profile Image</label>
                    <div class="col-md-6">
                        <input type="file" name="image4" onchange="previewFile4(this)" required>
                        <img id="previewImg4" height="150px">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            </fieldset>

            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Register">
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

    function previewFile2(input){
        var file2 = $("input[type=file]").get(1).files[0];
        if(file2)
        {
            var reader = new FileReader();
            reader.onload = function(){
                $('#previewImg2').attr("src", reader.result);
            }
            reader.readAsDataURL(file2);
        }
    }

    function previewFile3(input){
        var file3 = $("input[type=file]").get(2).files[0];
        if(file3)
        {
            var reader = new FileReader();
            reader.onload = function(){
                $('#previewImg3').attr("src", reader.result);
            }
            reader.readAsDataURL(file3);
        }
    }

    function previewFile4(input){
        var file4 = $("input[type=file]").get(3).files[0];
        if(file4)
        {
            var reader = new FileReader();
            reader.onload = function(){
                $('#previewImg4').attr("src", reader.result);
            }
            reader.readAsDataURL(file4);
        }
    }
</script>

@endsection