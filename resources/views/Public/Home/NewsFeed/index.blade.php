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
                                    <div class="d-none"><button class="getlike" data-id="{{$value[0]->id ?? ''}}">getlike</button></div>
                                    <div class="d-none"><button class="getcomments" data-id="{{$value[0]->id ?? ''}}">getComments</button></div>

                                    <div class="card-footer"><button type="button" class=" btn btn-default btn-sm likebtn" data-id="{{$value[0]->id ?? ''}}"><i class="like{{$value[0]->id ?? ''}} far fa-thumbs-up"></i> Like</button>
                                    <button type="button" class=" btn btn-default btn-sm commentbtn" id="commentbtn{{$value[0]->id ?? ''}}" data-id="{{$value[0]->id ?? ''}}" data-toggle="modal" data-target="#CommentModel{{$value[0]->id ?? ''}}"><i class="fas fa-comment"></i> Comment</button>
                                    <!-- Model For Comment Box -->
                                    <!-- Modal -->
                                        <div class="modal fade" id="CommentModel{{$value[0]->id ?? ''}}" tabindex="-1" role="dialog" aria-labelledby="CommentModelLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="CommentModelLabel"><i class="fas fa-comment"></i> Comments </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="overflow: auto; height: 20rem; display: flex; flex-direction: column-reverse;">
                                            <div class="container mt-1">
                                                <div class="commentsdata{{$value[0]->id ?? ''}}">
                                                    <!-- Here alll comment data come by jquery append -->
                                                </div>
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <!-- <div class="col-lg-2">
                                                            <img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40">
                                                        </div> -->
                                                        <div class="col-lg-12">
                                                            <textarea required class="form-control ml-1 shadow-none textarea{{$value[0]->id ?? ''}}"></textarea>
                                                        </div>
                                                        <div class="mt-2 text-right"><button class="btn btn-primary btn-sm shadow-none postcomment" data-id="{{$value[0]->id ?? ''}}" type="button">Post comment</button><button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button></div>
     
                                                </div>
                                            </div>                                                
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    <!-- End Comment Box Model -->
                                    <input type="hidden"  class="float-right text-muted countlikes{{$value[0]->id ?? ''}}" />
                                    <span class="float-right text-muted mylikes{{$value[0]->id ?? ''}}"> 0 - Likes </span>
                                    <input type="hidden" class="countcomments{{$value[0]->id ?? ''}}">
                                    <span class="mr-1 float-right text-muted mycomments{{$value[0]->id ?? ''}}"> 0 - Comments </span>
                                    </div>
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
                    // console.log(response);
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
<script>
    $(document).ready(function () {
        $('.likebtn').click(function () {
            // alert($(this).attr('data-id'));
            var post_id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                method: 'get',
                url: '{{url('/likepost')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    post_id: post_id,
                },
                success: function(response) {
                    // alert(response);
                    // console.log(response);
                    if(response[0] == true){
                        var num = Number($(".countlikes"+post_id).val()) + 1; 
                        $('.countlikes'+post_id).val(num);
                        // alert(num);
                        $('.mylikes'+post_id).html( num+' -  likes ');
                        $('.like'+post_id).addClass( ' text-info ' )
                    }else{
                        // alert('dislike')
                        // $('.countlikes'+post_id).val() - 1;
                        var num = Number($(".countlikes"+post_id).val()) - 1; 
                        $('.countlikes'+post_id).val(num);
                        // alert(num);
                        $('.mylikes'+post_id).html( num+' -  likes' );
                        $('.like'+post_id).removeClass(' text-info ');
                    }
                }
            });
        });
    });
</script>
<!-- Get Like Btn color And  Count Likes -->
<script>
    $(document).ready(function () {
        $('.getlike').trigger('click');   
    });
</script>
<script>
         $('.getlike').on('click', function () {
            var post_id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            // alert(post_id);
            $.ajax({
                method: 'get',
                url: '{{url('/checklikes')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    post_id: post_id,
                },
                success: function(response) {
                    if(response[1] == true){
                        $('.like'+post_id).addClass( ' text-info ' )
                        $('.mylikes'+post_id).html( response[0]+' -  likes ');
                        $('.countlikes'+post_id).val(response[0]);
                    }else{
                        $('.countlikes'+post_id).val(response[0]);
                        $('.mylikes'+post_id).html( response[0]+' -  likes ');
                    }
                    // console.log(response[0]);
                    // console.log(response[1]);
                }
            });

        });

</script>
<!-- Get Like Btn color And  Count Likes -->
<script>
    $(document).ready(function () {
        $('.getcomments').trigger('click');   
    });
</script>
<script>
         $('.getcomments').on('click', function () {
            var post_id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            // alert(post_id);
            $.ajax({
                method: 'get',
                url: '{{url('/countcomments')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    post_id: post_id,
                },
                success: function(response) {
                    // alert(response);
                    // console.log(response);
                    if(response[1] == true){
                        // $('.like'+post_id).addClass( ' text-info ' )
                        $('.mycomments'+post_id).html( response[0]+' -  Comments ');
                        $('.countcomments'+post_id).val(response[0]);
                    }else{
                        $('.countcomments'+post_id).val(response[0]);
                        $('.mycomments'+post_id).html( response[0]+' -  Comments ');
                    }
                    // console.log(response[0]);
                    // console.log(response[1]);
                }
            });

        });

</script>
<!-- get Comment And print all comments -->
<script>
    $(document).ready(function() {
        $('.commentbtn').click(function() {
            var token = $("meta[name='csrf-token']").attr("content");
            var post_id = $(this).attr("data-id");
            // alert(post_id);
            $.ajax({
                method: 'get',
                url: '{{url('/comments')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    post_id: post_id,
                },
                success: function(response) {
                //    alert(response);
                   $('.commentsdata'+post_id).html("");
                //    console.log(response);
                   if(response[1] == true){
                    // console.log(response);
                    // console.log(response[0].length);
                    for(var i=0;i<response[0].length;i++){
                        $('.commentsdata'+post_id).append('<div class="row"><div class="col-md-12"><div class="d-flex flex-column comment-section" style=""><div class="d-flex flex-row user-info"><img class="rounded-circle" src="{{asset("Profile_images")}}/'+response[0][i][0]['picture']+'"width="40"><div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">'+response[0][i][0]['name']+'</span></div></div><div class="mt-2"><p class="comment-text">'+response[0][i]['comment']+'</p></div></div></div></div>');   
                    }
                    $('.mycomments'+post_id).html(response[0].length+" Comments ");
                   }else{
                    $('.commentsdata'+post_id).append('<div class="text-center"><em>Be The First Comment On This Post</em></div>');
                    // alert('done');
                   }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.postcomment').click(function() {
            var token = $("meta[name='csrf-token']").attr("content");
            var post_id = $(this).attr('data-id');
            var comment = $('.textarea'+post_id).val();
            $.ajax({
                method: 'get',
                url: '{{url('/commentpost')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    post_id: post_id,
                    comment: comment,
                },
                success: function(response) {
                    if(response[0] == true){
                        $('#commentbtn'+post_id).click();
                        $('.textarea'+post_id).val(null);
                        console.log(response);
                    }else{
                        alert("message can not be empty");
                    }
                }
            });
        });
    });
</script>
@endsection
