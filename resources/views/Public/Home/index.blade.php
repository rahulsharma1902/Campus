@extends('Public.index')
@section('home')
@if(Auth::user())
<!-- Start story section -->
<section class="storysection">
<?php if(Auth::user()->user_type == 1){
            $profile = 'admin';
        }elseif(Auth::user()->user_type == 2){
            $profile = 'student';
            }elseif(Auth::user()->user_type == 3){
                $profile = 'staff';
                } elseif(Auth::user()->user_type == 4){
                    $profile = 'sponsor';
                    }elseif(Auth::user()->user_type == 5){
                        $profile = 'alumni';
                        }
?>
<div class="container my-3">
    <div class="row">
        <div class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="pb-0">Stories</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div id="content_1" class="tabcontent story-area"> 
                                <div class="story-container-1">
                                    <div class="single-create-story">
                                        <img src="{{asset('Profile_images')}}/{{$userdata[$profile]['picture']}}" class="single-create-story-bg">
                                        <div class="create-story-author">
                                        <label for="file"><i class="addstory fa fa-plus-circle fa-2x text-info"></i>
                                           <p>Create a story</p></label>
                                            <input type="file" id ="file" name="video" style="display:none">
                                        </div> 
                                    </div>
                                    <script>
                                        $(document).ready(function(){
                                            $('#file').change(function(){
                                                file = $(this).files[0];
                                                console.log(file);
                                    
                                            })
                                        });
                                    </script>
                                    <div class="single-story">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" class="single-story-bg">
                                        <div class="story-author">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png">
                                            <p>John</p>
                                        </div>
                                    </div>
                                    <div class="single-story">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="single-story-bg">
                                        <div class="story-author">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png">
                                            <p>Mike</p>
                                        </div>
                                    </div>
                                    <div class="single-story">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar4.png" class="single-story-bg">
                                        <div class="story-author">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar4.png">
                                            <p>Lisa</p>
                                        </div>
                                    </div>
                                    <div class="single-story">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar5.png" class="single-story-bg">
                                        <div class="story-author">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar5.png">
                                            <p>William</p>
                                        </div>
                                    </div>
                                    <div class="single-story">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="single-story-bg">
                                        <div class="story-author">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png">
                                            <p>Jonthy</p>
                                        </div>
                                    </div>
                                    <div class="single-story">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="single-story-bg">
                                        <div class="story-author">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png">
                                            <p>Steve</p>
                                        </div>
                                    </div>
                                    <div class="single-story">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar8.png" class="single-story-bg">
                                        <div class="story-author">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar8.png">
                                            <p>Jenni</p>
                                        </div>
                                    </div>
                                    <div class="single-story">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="single-story-bg">
                                        <div class="story-author">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                            <p>Sagarika</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
<!-- End Story section -->
<section>

<div class="container-fluid my-5">
    <a href="/studentoftheweek" class="btn btn-success"><i class="fas fa-poll-people"></i>Vote For Student</a>
    <a href="/staffoftheweek" class="btn btn-success"><i class="fas fa-poll-people"></i>Vote For Staff</a>
    <div class="row my-5">
        <div class="col-sm-4">
            <div class="position-relative">
                <div class="card">
                    <div class="card-header">
                        <img src="{{asset('Profile_images/167704644265.avif')}}" alt="studentoftheweek" class="img-fluid studentoftheweek">
                        <div class="ribbon-wrapper ribbon-xl">
                            <div class="ribbon bg-success text-sm">Student Of The Week</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="studentname"><em>No Vote Available</em></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="position-relative">
                <div class="card">
                    <div class="card-header">
                        <img src="{{asset('Profile_images/167704644265.avif')}}" alt="studentoftheweek" class="img-fluid staffoftheweek">
                        <div class="ribbon-wrapper ribbon-xl">
                            <div class="ribbon bg-success text-sm">Staff Of The Week</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="staffname"><em>No Vote Available</em></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endif

<section>
<div class="container col-lg-6">
    @if($postData)
        @foreach($postData as $post)
       
        <div class="card">
            <div class="card-header"> {{$post->description ?? ''}}</div>
            <div class="card-body">
                <img src="{{asset('products_images')}}/{{$post->image}}" alt="" style='width: 100%; height: 20rem;'>
            </div>
            
            <div class="card-footer">
                <span>Post by : <b><?php print_r($post->name); ?></b> </span> <br>
                <span>{{(new Carbon\Carbon($post->created_at))->diffForHumans()}}</span>
            </div>
        </div>
        @endforeach
    @endif
</div>
</section>
<!-- * Script for Get Student Of the week -->
<script>
    $(document).ready(function () {
        var curr = new Date; // get current date
        var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
        var last = first + 6; // last day is the first day + 6

        var firstday = new Date(curr.setDate(first)).toUTCString();
        var lastday = new Date(curr.setDate(last)).toUTCString();
        /** Function for conver toUTCString to y-m-d  */
        function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [year, month, day].join('-');
            }
        // console.log(formatDate(firstday));
        // console.log(formatDate(lastday));
        var end_date = formatDate(lastday);
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
                method: 'get',
                url: '{{url('/getstudentoftheweek')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    end_date: end_date,
                },
                success: function(response) {
                    // alert(response);
                    // console.log(response[0]['picture']);
                    // console.log(responsepicture);
                    if(response[0]['picture']!= null){
                    var src =  $(".studentoftheweek").src = "{{asset('Profile_images')}}/"+response[0]['picture'];
                    $('.studentoftheweek').attr('src', src);
                    $(".studentname").html("Name :"+response[0]['name']);
                    }else{
                        var src = '{{asset("Profile_images/167704644265.avif")}}';
                        $('.studentoftheweek').attr('src', src);
                        $(".studentname").html("No Vote Available");
                        
                    }
                    // location.reload();
                    // console.log(imgsource);
                }
            });
    });
</script>
<!-- Script for get staff of the week -->
<script>
    $(document).ready(function () {
        var curr = new Date; // get current date
        var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
        var last = first + 6; // last day is the first day + 6

        var firstday = new Date(curr.setDate(first)).toUTCString();
        var lastday = new Date(curr.setDate(last)).toUTCString();
        /** Function for conver toUTCString to y-m-d  */
        function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [year, month, day].join('-');
            }
        console.log(formatDate(firstday));
        console.log(formatDate(lastday));
        var end_date = formatDate(lastday);
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
                method: 'get',
                url: '{{url('/getstaffoftheweek')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    end_date: end_date,
                },
                success: function(response) {
                    // alert(response);
                    // console.log(response);
                    console.log(response[0]['picture']);
                    // console.log(responsepicture);
                    if(response[0]['picture']!= null){
                    var src =  $(".studentoftheweek").src = "{{asset('Profile_images')}}/"+response[0]['picture'];
                    $('.staffoftheweek').attr('src', src);
                    $(".staffname").html("Name :"+response[0]['name']);
                    }else{
                        var src = '{{asset("Profile_images/167704644265.avif")}}';
                        $('.staffoftheweek').attr('src', src);
                        $(".staffname").html("No Vote Available");
                        
                    }
                    // location.reload();
                    console.log(imgsource);
                }
            });
    });
</script>

@endsection