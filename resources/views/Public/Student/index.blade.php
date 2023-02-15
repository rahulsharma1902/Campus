@extends('Public.index')
@include('Public.Student.sidebar')
@section('student_profile')
<div class="content-wrapper mt-4">
    <section class="content">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger mt-2" id="danger-alert">

            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Error!</strong>{{ $error }}

        </div>
        @endforeach
        @endif
        @if ($message = Session::get('success'))
        <div class="dismiss alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Success!</strong>
            {{$message}}
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="dismiss alert alert-danger" id="danger-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>!</strong>
            {{$message}}
        </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @foreach ($student_profile as $s_p )
                    @endforeach
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <form action="{{url('/studentprofile/upload')}}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <label for="profilepic">
                                        <img class="profile-user-img img-fluid img-circle" src="@if (!empty($s_p->picture)){{asset('/Profile_images')}}/{{$s_p->picture}}  
                                            @else
                                            http://bootdey.com/img/Content/avatar/avatar1.png   
                                            @endif  
                                            ">
                                    </label>
                                    <input type="file" id="profilepic" name="profilepic" style="display:none;">

                                    <input type="hidden" name='student_id' value='{{$s_p->id ?? ""}}'>

                            </div>
                            <h3 class="profile-username text-center">{{{$s_p->name ?? ''}}}</h3>
                            <p class="text-muted text-center">{{{$s_p->about_me ?? ''}}}</p>
                            <button type='submit' class='btn btn-info btn-block'>Upload New</button>
                        </div>
                        </form>

                    </div>




                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings"
                                        data-toggle="tab">Profile Settings</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <form class="form-horizontal" method='POST' action='{{ url("/studentprofile/save")}}'>
                                    @csrf


                                    <input type="hidden" name='student_id' value='{{$s_p->id ?? ""}}'>
                                    <div class="form-group">
                                        <label for="name" class="form-group">Name</label>
                                        <input type="text" class='form-control' name='name' id='name'
                                            value='{{$s_p->name ?? ""}}'>
                                    </div>
                                    <div class="form-group">
                                        <label for="about-me" class="form-group">About Me</label>
                                        <input type="text" class='form-control' name='about_me' id='about-me'
                                            value='{{$s_p->about_me ?? ""}}'>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="">College Name</label>
                                            <select name="college_id" id="" class='form-control'
                                                value='{{$s_p->college_id ?? ""}}'>
                                                <option value='{{$s_p->college_id ?? ""}}' selected>Select Your College
                                                    Name</option>
                                                @foreach ($college as $c)
                                                <option value="{{$c->id}}">{{$c->college_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="course">Course Name</label>
                                            <select name="course_id" id="course" class='form-control'
                                                value='{{$s_p->course_id ?? ""}}'>
                                                <option value='{{$s_p->course_id ?? ""}}' selected>Select Your Course
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="level" class="form-group">level</label>
                                            <input type="number" class='form-control' name='level' id='level'
                                                value='{{$s_p->level ?? ""}}'>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="state_of_origin" class="form-group">State of Origin</label>
                                            <input type="text" class='form-control' name='state_of_origin'
                                                id='state_of_origin' value='{{$s_p->state_of_origin ?? ""}}'>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="form-group col-lg-6">
                                            <label for="" class="form-group"> Authenticate Student</label>
                                            <select name="authenticate_student" id="" class='form-control'
                                                value='{{$s_p->authenticate_student ?? ""}}'>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="location" class="form-group"> Location</label>
                                            <input name='location' id='location' type="text" class='form-control'
                                                placeholder='Enter Your Location' value='{{$s_p->location ?? ""}}'>

                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="social_links" class="form-group">Social Link</label>
                                        <input type="text" class='form-control' name='social_links' id='social_links'
                                            placeholder='Copy Your Link Here' value='{{$s_p->social_links ?? ""}}'>
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