@extends('Public.index')
@include('Public.Student.sidebar')
@section('student_profile')
<div class="content-wrapper">
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-3">

<div class="card card-primary card-outline">
<div class="card-body box-profile">
<div class="text-center">
<img class="profile-user-img img-fluid img-circle" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="User profile picture">
</div>
<h3 class="profile-username text-center">Nina Mcintire</h3>
<p class="text-muted text-center">Software Engineer</p>
<ul class="list-group list-group-unbordered mb-3">
<li class="list-group-item">
<b>Followers</b> <a class="float-right">1,322</a>
</li>
</ul>
<a href="#" class="btn btn-primary btn-block"><b>Upload New Photo</b></a>
</div>

</div>




</div>

<div class="col-md-9">
<div class="card">
<div class="card-header p-2">
<ul class="nav nav-pills">
    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Profile Settings</a></li>
</ul>
</div>
<div class="card-body">
<div class="tab-content">
<form class="form-horizontal" method='POST'>
    <div class="form-group">
        <label for="name" class="form-group">Name</label>
        <input type="text" class='form-control' name='name' id='name'>
    </div>
    <div class="form-group">
        <label for="about-me" class="form-group">About Me</label>
        <input type="text" class='form-control' name='about_me' id='about-me'>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label for="">College Name</label>
       <select name="college_name" id="" class='form-control'>
        <option value="">Select Your College Name</option>
       </select></div>
       <div class="col-lg-6">
        <label for="">Course Name</label>
       <select name="course" id=""  class='form-control'>
        <option value="">Select Your Course</option>
       </select></div>
    </div>
    <div class="row">
    <div class="form-group col-lg-6">
        <label for="" class="form-group">level</label>
        <input type="text" class='form-control' name='' id=''>
    </div>
    <div class="form-group col-lg-6">
        <label for="" class="form-group">State of Origin</label>
        <input type="text" class='form-control' name='' id=''>
    </div>
    </div>
    <div class="row">

    <div class="form-group col-lg-6">
        <label for="" class="form-group"> Authenticate Student</label>
        <select name="authenticate_student" id="" class='form-control'>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>
    <div class="form-group col-lg-6">
        <label for="" class="form-group"> Location</label>
        <input type="text" class='form-control' placeholder='Enter Your Location'>
        
    </div>

</div>
    <div class="form-group">
        <label for="social_link" class="form-group">Social Link</label>
        <input type="text" class='form-control' name='social_link' id='social_link' placeholder='Copy Your Link Here'>
    </div>
    <div class="form-group">
        <button class='btn btn-success btn-block'>Submit</button>
    </div>
</form>
</div>

</div>

</div>
</div>

</div>

</div>

</div>
</section>
</div>
@endsection
 