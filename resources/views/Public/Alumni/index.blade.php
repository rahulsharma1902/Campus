@extends('Public.index')
@include('Public.Alumni.sidebar')
@section('alumni_profile')
<div class="content-wrapper mt-4">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @foreach ($alumni_profile as $a_p )
                    @endforeach
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <form action="{{url('/alumniprofile/upload')}}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <label for="profilepic">
                                    <img class="profile-user-img img-fluid img-circle" src="@if (!empty($s_p->picture)){{asset('/Profile_images')}}/{{$s_p->picture}}  
                                            @else
                                            http://bootdey.com/img/Content/avatar/avatar1.png   
                                            @endif  
                                            ">                                    </label>
                                    <input type="file" id="profilepic" name="profilepic" style="display:none;">

                                    <input type="hidden" name='alumni_id' value='{{$a_p->id ?? ""}}'>

                            </div>
                            <button type='submit' class='btn  btn-sm btn-dark btn-block'>Upload</button>
                            <h3 class="profile-username text-center">{{{$a_p->name ?? ''}}}</h3>
                            <p class="text-muted text-center">{{{$a_p->about_me ?? ''}}}</p>
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

                                <form class="form-horizontal" method='POST' action='{{ url("/alumniprofile/save")}}'>
                                    @csrf
                                    <input type="hidden" name='alumni_id' value='{{$a_p->id ?? ""}}'>
                                    <div class="form-group">
                                        <label for="name" class="form-group">Name</label>
                                        <input type="text" class='form-control' name='name' id='name'
                                            value='{{$a_p->name ?? ""}}'>
                                    </div>
                                    <div class="form-group">
                                        <label for="about-me" class="form-group">About Me</label>
                                        <input type="text" class='form-control' name='about_me' id='about-me'
                                            value='{{$a_p->about_me ?? ""}}'>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="college_id">College Graduated From</label>
                                                <select name="college_id" id="college_id" class='form-control'
                                                    value='{{$a_p->college_graduated_from ?? ""}}'>
                                                    <option value='{{$a_p->college_graduated_from ?? ""}}' selected>Select Your
                                                        College Name</option>
                                                    @foreach ($college as $c)
                                                    <option value="{{$c->id}}">{{$c->college_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="social_links" class="form-group">Social Link</label>
                                                <input type="text" class='form-control' name='social_links'
                                                    id='social_links' placeholder='Copy Your Link Here'
                                                    value='{{$a_p->social_links ?? ""}}'>
                                            </div>
                                        </div>
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