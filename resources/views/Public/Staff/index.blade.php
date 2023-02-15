@extends('Public.Profile.Header')
@section('staff_profile')
@include('Public.Staff.sidebar')
<div class="container" style="min-height: 500.44px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center">
            <h1>@if($userdata){{$userdata->name}}@endif profile</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                    <?php $staff_id = Auth()->user();
                  ?>
                <form action="{{url('/Staff/profile/upload')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <input type="hidden" name="user_id" value="{{$staff_id->id}}">
                <label for="file">
                  <img class="profile-user-img img-fluid img-circle" src="@if($userdata) {{asset('Profile_images')}}/{{$userdata->picture}} @else{{asset('admin')}}/dist/img/user4-128x128.jpg @endif" alt="User profile picture">
                  </label>
                  <input type="file" name="profilepic" id ="file" style="display:none;">
                  <button class="btn btn-block btn-info btn-xs">Upload</button>
                  </form>
                </div>

                <h3 class="profile-username text-center">@if($userdata){{$userdata->name}}@endif</h3>

                <p class="text-muted text-center">@if($userdata){{$userdata->college_name}}@endif</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <!-- <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li> -->
                </ul>

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                @if($userdata){{$userdata->dept_name}} {{$userdata->position_name}}@endif
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">@if($userdata){{$userdata->location}}@endif</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i>social_links</strong>

                <p class="text-muted">
                @if($userdata) <a href="{{$userdata->social_links}}">{{$userdata->social_links}}</a>@endif
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> About</strong>

                <p class="text-muted">@if($userdata){{$userdata->about_me}}@endif</p>
              </div>
                   
                  </div>
                 

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="{{url('/Staff/profile/insert')}}" method="post">
                        @csrf
                      <div class="form-group row">
                        <input type="hidden" name="id" value="{{$staff_id->id}}" >
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name = "name" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="aboutme" class="col-sm-2 col-form-label">About me</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name= "about_me" id="aboutme">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="College" class="col-sm-2 col-form-label">College</label>
                        <div class="col-sm-10">
                           
                        <select class="form-control select2 select2-hidden-accessible" required id ="College" name="college_id" style="width: 100%;" data-select2-id="9" tabindex="-1" aria-hidden="true">
                            <option disabled selected value="">Select Your College Name</option>
                            @foreach($college as $c)
                            <option value="{{$c->id}}" >{{$c->college_name}}</option>
                            @endforeach
                        </select>
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label for="department" class="col-sm-2 col-form-label">Position</label>
                        <div class="col-sm-10">
                        <select class="form-control select2 select2-hidden-accessible" id ="position" name="position_id" style="width: 100%;" data-select2-id="9" tabindex="-1" aria-hidden="true">
                          
                        </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="department" class="col-sm-2 col-form-label">Departments</label>
                        <div class="col-sm-10">
                        <select class="form-control select2 select2-hidden-accessible" name="dept_id" id ="department" style="width: 100%;" data-select2-id="9" tabindex="-1" aria-hidden="true">
                           
                            
                        </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="sociallink" class="col-sm-2 col-form-label">Social links</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="sociallink" name="social_links">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="location" class="col-sm-2 col-form-label">Location</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="location" name="location">
                        </div>
                      </div>
                      <div class="form-group row">
                       <button class="btn btn-primary ">Update</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<script>
    $('#College').change(function(){
       val = $(this).val();
       $.ajax({
        method: 'post',
        url: '{{url('/Staff/profile/collegedata')}}',
        dataType: 'json',
        data: {_token: '{{csrf_token()}}', id:val},
        success: function(response)
        {
           const divdata = [];
            $.each(response[0], function(key,value){
               option =  '<option value="'+value.id+'">'+value.dept_name+'</option>';
             divdata.push(option);
            }); 
         
            $('#department').html(divdata);
            const position = [];
            $.each(response[1], function(key,value){
               options =  '<option value="'+value.id+'">'+value.position_name+'</option>';
            position.push(options);
            });
            $('#position').html(position);
        }
        });
    });
</script>

@endsection
 