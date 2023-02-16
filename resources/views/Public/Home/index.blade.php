@extends('Public.index')
@section('home')
<section>
<div class="container-fluid my-5">
    <a href="/studentoftheweek" class="btn btn-success"><i class="fas fa-poll-people"></i>Vote For Student</a>
    <a href="/staffoftheweek" class="btn btn-success"><i class="fas fa-poll-people"></i>Vote For Staff</a>
    <div class="row my-5">
        <div class="col-sm-4">
            <div class="position-relative">
                <div class="card">
                    <div class="card-header">
                        <img src="" alt="studentoftheweek" class="img-fluid studentoftheweek">
                        <div class="ribbon-wrapper ribbon-xl">
                            <div class="ribbon bg-success text-sm">Student Of The Week</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="studentname"></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="position-relative">
                <div class="card">
                    <div class="card-header">
                        <img src="" alt="studentoftheweek" class="img-fluid staffoftheweek">
                        <div class="ribbon-wrapper ribbon-xl">
                            <div class="ribbon bg-success text-sm">Staff Of The Week</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="staffname"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
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
                        var src = 'https://pbs.twimg.com/profile_images/681337437226938368/31sRHb4V_400x400.jpg';
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
                        var src = 'https://pbs.twimg.com/profile_images/681337437226938368/31sRHb4V_400x400.jpg';
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