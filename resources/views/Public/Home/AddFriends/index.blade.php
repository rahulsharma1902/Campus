@extends('Public.index')
@section('addfriends')
<section>
    <div class="container col-lg-4">
        @foreach($users as $user)
        <div class="my-2">
            <div class="card-header userdata <?php if(Auth::user()->id == $user->id){ echo 'd-none'; }else{ echo 'd-block';} ?>">
                <div class="user-block">
                    <img class="img-circle userimg{{$user->id ?? ''}}" src="" alt="User Image">
                    <span class="username">{{$user->real_name ?? ""}}</span>
                    <!-- <span class="description">Description not avlaible</span> -->
              <div class="d-none"> <button class="useriddbtn" data-id="{{$user->id ?? ''}}">View Image</button></div>  
                </div>
                <div class="card-tools">
                    <button type="button" class="followuser btn btn-dark  btnflw{{$user->id ?? ''}}" title="Follow" data-id="{{$user->id ?? ''}}">
                    Follow <i class="ui-icon fas fa-user-plus"></i>
                    </button>
                    <!-- <button type="button" class="unfollowuser btn btn-tool btn-danger" data-card-widget="collapse" data-id="{{$user->id ?? ''}}">
                    Unfollow
                    </button> -->
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- Script for get all Images Of all users  -->
<script>
    $(document).ready(function () {
        $('.useriddbtn').trigger('click');
   
        
    });
</script>
<script>
         $('.useriddbtn').on('click', function () {
            var user_id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                method: 'get',
                url: '{{url('/userimage')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    user_id: user_id,
                },
                success: function(response) {
                    // alert(response);
                    // console.log(response[0]);
                    // console.log(response[0][0]);
                    // console.log(response[0][1]);
                    // $('.userimg').attr('src', response);
                    // console.log(response[0]);
                    var src =  $(".userimg"+user_id).src = "{{asset('Profile_images')}}/"+response[0][0];
                    $('.userimg'+user_id).attr('src', src);
                    $('.btnflw'+user_id).html(response[0][1]);
                    $('.btnflw'+user_id).attr('title',response[0][1]);
                }
            });

        });

</script>
<script>
    $(document).ready(function () {
        $('.followuser').on('click', function () {
            var friend_id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            // alert(user_id);
            $.ajax({
                method: 'get',
                url: '{{url('/followuser')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    friend_id: friend_id,
                },
                success: function(response) {
                    // alert(" Done Successfully");
                    if(response == false){
                        $('.btnflw'+friend_id).html("Follow");
                        // $('.btnflw'+friend_id).find('.ui-icon').removeClass('fa-user-plus').addClass('fa-user-minus');
                        $('.btnflw'+friend_id).attr('title','follow User');
                        // alert("You are unfollow");
                    }else{
                        // $('.btnflw'+friend_id).html(<i class="fas fa-user-minus"></i>);
                        $('.btnflw'+friend_id).html("Unfollow");
                        $('.btnflw'+friend_id).attr('title','Unfollow User');
                        // alert('follow');
                    }
                    // $('.btnflw'+friend_id).html(response);
                    // $('.btnflw'+friend_id).attr('title',response);

                    // console.log(response);
                }
            });
        });
    });
</script>
@endsection