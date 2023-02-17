@extends('Public.index')
@section('newsfeed')
<section>
    <div class="container">
        <div class="form-group my-3">
            <form action="/uploadpost" method="post" enctype="multipart/form-data">   
                <div class="col-md-12">
                    @csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">News Feed <small><em>UPLOAD YOUR POST HERE</em></small></h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Post Title</label>
                                <input type="text" class="form-control" name="post_title" placeholder="Something about your post" required />
                            </div>
                            <div class="form-group">
                                    <label for="">Upload Image</label>
                                    <input type="file" name="postimg" id="postimg" class=" text-danger" />
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <button type='submit' class="btn btn-dark btn-block">Upload Post</button>
                            </div>
                        </div>
                    </div>
                </div>   
            </form>
        </div> 
    </div>
    <hr>
    <div class="container-fluid">
        <div class="card">
            <div class="card card-default">
                <div class="card-header">See All Posts</div>
                    <div class="card-body">
                        @if(count($followPOST) != 0)
                            @foreach($followPOST as $key=>$value)
                                @if(count($value) != 0)
                                    @for($i=0; $i < count($value); $i++)
                            <div class="container col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                    <div class="media">
                                    <img src="" alt="User Avatar" class="userimg{{$value[0]->upload_by ?? ''}} img-size-50 img-circle mr-3" style="height: 3rem;">
                                    <div class="d-none"> <button class="useriddbtn" data-id="{{$value[0]->upload_by ?? ''}}">View Image</button></div>
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title name{{$value[0]->upload_by ?? ''}}"> </h3>
                                            <!-- <p class="text-sm">I got your message bro</p> -->
                                        </div>
                                    </div>
                                    <hr>
                                        {{$value[$i]->post_title ?? ''}}
                                    </div>
                                    <div class="card-body">
                                        <img src="{{asset('products_images')}}/{{$value[0]->image ?? ''}}" alt="" style='width: 100%; height: 20rem;'>
                                    </div>
                                    <div class="card-footer">like</div>
                                </div>
                            </div>
                                    @endfor
                                @endif
                            @endforeach
                            @else
                            <h4 class="text-center"><small><em>Follow Users For See Latest Posts</em></small></h4>
                        @endif    
                    </div>
                <div class="card-footer"></div>
            </div>
        </div>
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
                url: '{{url('/usersdata')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    user_id: user_id,
                },
                success: function(response) {
                    // alert(response);
                    console.log(response);
                    // console.log(response[0]['name']);
                    // console.log(response[0]['picture']);
                    // $('.userimg').attr('src', response);
                    // // console.log(response[0]);
                    var src =  $(".userimg"+user_id).src = "{{asset('Profile_images')}}/"+response[0]['picture'];
                    $('.userimg'+user_id).attr('src', src);
                    $('.name'+user_id).html(response[0]['name']);
                    // $('.btnflw'+user_id).attr('title',response[0][1]);
                }
            });

        });

</script>
@endsection
