@extends('Public.Profile.Header')
@section('staff_profile')
@include('Public.Staff.sidebar')
<!-- Start Add Post section -->
<section>
    <div class="container-fluid">
        <div class="form-group my-3">
            <form action="/uploadcollegepost" method="post" enctype="multipart/form-data">   
                <div class="col-md-12">
                    @csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">College Post <small><em>UPLOAD YOUR COLLEGE POST HERE</em></small></h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Post Title</label>
                                <input type="text" class="form-control" name="description" placeholder="Something about your post" required />
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
 </div>   <hr>
   <!-- ======= Book A Table Section ======= -->
   <section id="book-a-table" class="book-a-table">
      <div class="container">

        <div class="section-title">
          <h2>Make a <span>Event</span></h2>
          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
        </div>

        <form action="forms/book-a-table.php" method="post" role="form" class="php-email-form">
          <div class="row">
            <div class="col-lg-4 col-md-6 form-group mt-3">
              <input type="text" title="Event Name" name="name" class="form-control" id="name" placeholder="Event Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
            </div>
            <div class="col-lg-4 col-md-6 form-group mt-3">
              <input type="date" title="Event Date" name="date" class="form-control" id="date" placeholder="Event Date" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
            </div>
            <div class="col-lg-4 col-md-6 form-group mt-3 ">
              <input type="number" title="Event Cost" class="form-control" name="event_cost" id="event_cost" placeholder="Event Cost">
            </div>
            <div class="col-lg-4 col-md-6 form-group mt-3 ">
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
            </div>
            <div class="col-lg-4 col-md-6 form-group mt-3">
              <input type="time" class="form-control" name="time" id="time" placeholder="Time" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
            </div>
            <div class="col-lg-4 col-md-6 form-group mt-3">
              <input type="number" class="form-control" name="people" id="people" placeholder="# of people" data-rule="minlen:1" data-msg="Please enter at least 1 chars">
            </div>
          </div>
          <div class="my-2"><button type="submit" class="btn btn-info">Make Event</button></div>
        </form>

      </div>
    </section><!-- End Book A Table Section -->
<!-- My Posts -->
<div class="container-fluid">
        <div class="card">
            <div class="card card-default">
                <div class="card-header">See All My Posts</div>
                    <div class="card-body">
                            @for($i=0;$i< count($data['mypost']);$i++)
                            <div class="container col-lg-6 mypost{{$data['mypost'][$i]['id'] ?? ''}}">
                                <div class="card">
                                    <div class="card-header">
                                    <div class="media">
                                        <img src="{{asset('Profile_images')}}/{{$data['mypost'][$i]['staffprofile']['picture'] ?? ''}}" alt="User Avatar" class=" img-size-50 img-circle mr-3" style="height: 3rem;">
                
                                        <div class="media-body">
                                            <div class="d-flex bd-highlight">
                                                <div class="p-2 w-100 bd-highlight">{{$data['mypost'][$i]['staffprofile']['name'] ?? ''}}</div>
                                                <div class="p-2 flex-shrink-1 bd-highlight"><i class="fas fa-trash-alt text-danger deletemypost" data-id="{{$data['mypost'][$i]['id'] ?? ''}}"></i></div>
                                            </div>
                                            <div class="w-100 bd-highlight" style="font-size: smaller;"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($data['mypost'][$i]['created_at'])->diffForHumans() }}</div>

                                        </div>
                                    </div>
                                    <hr>
                                        {{$data['mypost'][$i]['description'] ?? ''}}
                                    </div>
                                    <div class="card-body">
                                        <img src="{{asset('products_images')}}/{{$data['mypost'][$i]['image'] ?? ''}}" alt="" style='width: 100%; height: 20rem;'>
                                    </div>
                                    <div class="d-none"><button class="getlike" data-id="{{$data['mypost'][$i]['id'] ?? ''}}">getlike</button></div>
                                    <div class="d-none"><button class="getcomments" data-id="">getComments</button></div>

                                    <div class="card-footer"><button type="button" class=" btn btn-default btn-sm likebtn" data-id="{{$data['mypost'][$i]['id'] ?? ''}}"><i class="like{{$data['mypost'][$i]['id'] ?? ''}} far fa-thumbs-up"></i> Like</button>
                                    <button type="button" class=" btn btn-default btn-sm commentbtn" id="commentbtn{{$data['mypost'][$i]['id'] ?? ''}}" data-id="{{$data['mypost'][$i]['id'] ?? ''}}" data-toggle="modal" data-target="#CommentModel"><i class="fas fa-comment"></i> Comment</button>
                                    <!-- Model For Comment Box -->
                                    <!-- Modal -->
                                        <div class="modal fade" id="CommentModel" tabindex="-1" role="dialog" aria-labelledby="CommentModelLabel" aria-hidden="true">
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
                                                <div class="commentsdata{{$data['mypost'][$i]['id'] ?? ''}}">
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
                                                            <textarea required class="form-control ml-1 shadow-none textarea{{$data['mypost'][$i]['id'] ?? ''}}"></textarea>
                                                        </div>
                                                        <div class="mt-2 text-right"><button class="btn btn-primary btn-sm shadow-none postcomment" data-id="{{$data['mypost'][$i]['id'] ?? ''}}" type="button">Post comment</button><button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button></div>
     
                                                </div>
                                            </div>                                                
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    <!-- End Comment Box Model -->
                                    <input type="hidden"  class="float-right text-muted countlikes{{$data['mypost'][$i]['id'] ?? ''}}" value="{{$data['mypost'][$i]['postlikes_count']}}"/>
                                    <span class="float-right text-muted mylikes{{$data['mypost'][$i]['id'] ?? ''}}"> {{$data['mypost'][$i]['postlikes_count'] ?? ''}} - Likes </span>
                                    <input type="hidden" class="countcomments{{$data['mypost'][$i]['id'] ?? ''}}">
                                    <span class="mr-1 float-right text-muted mycomments{{$data['mypost'][$i]['id'] ?? ''}}"> {{$data['mypost'][$i]['postcomments_count'] ?? ''}} - Comments </span>
                                    </div>
                                </div>
                            </div>
                            @endfor
                                                  
                    </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>

</section>
<script>
    $(document).ready(function () {
        $('.deletemypost').on('click', function (){
            var post_id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                // conferm code for delete post :: 
                $.ajax({
                method: 'get',
                url: '{{url('/deletecollegepost')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    post_id: post_id,
                },
                success: function(response) {
                    console.log(response);
                    if(response == true){
                    swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your Post has been deleted.',
                    'success'
                    ) 
                    $('.mypost'+post_id).addClass('d-none');
                    }else{
                        swalWithBootstrapButtons.fire(
                    'Failed!',
                    'Post Not Found.',
                    'error'
                    )   
                    }
                }
            });
               
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your Post is safe :)',
                'error'
                )
            }
            })
        });
    });
</script>
<!-- Check Liked Or Not By Active user  -->
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
                url: '{{url('/checklikesbyme')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    post_id: post_id,
                },
                success: function(response) {
                    if(response[0] == true){
                        if(response[1] == 'unlike'){
                            $('.like'+post_id).addClass( ' text-info ' )
                        }else{
                            $('.like'+post_id).removeClass( ' text-info ' )
                        }
                    }
                }
            });

        });

</script>
<!-- LIKE COLLEGE POST :: -->
<script>
    $(document).ready(function () {
        $('.likebtn').click(function () {
            // alert($(this).attr('data-id'));
            var post_id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                method: 'get',
                url: '{{url('/likecollegepost')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    post_id: post_id,
                },
                success: function(response) {
                    if(response[0] == true){
                        if(response[1] == 'like'){
                            $('.like'+post_id).addClass( ' text-info ' )
                            var num = Number($(".countlikes"+post_id).val()) + 1; 
                            $('.countlikes'+post_id).val(num);
                            $('.mylikes'+post_id).html( num+' -  likes' );
                        }else{
                            $('.like'+post_id).removeClass( ' text-info ' );
                            var num = Number($(".countlikes"+post_id).val()) - 1; 
                            $('.countlikes'+post_id).val(num);
                            $('.mylikes'+post_id).html( num+' -  likes' );
                            
                        }
                    }
                    
                }
            });
        });
    });
</script>

<!-- Script for get comments  -->
<script>
    $(document).ready(function() {
        $('.commentbtn').click(function() {
            var token = $("meta[name='csrf-token']").attr("content");
            var post_id = $(this).attr("data-id");
            // alert(post_id);
            $.ajax({
                method: 'get',
                url: '{{url('/getcommentcollegepost')}}',
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
                url: '{{url('/commentcollegepost')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    post_id: post_id,
                    comment: comment,
                },
                success: function(response) {
                    // console.log(response);
                    if(response[0] == true){
                        var num = Number($(".countcomments"+post_id).val()) + 1; 
                            $('.mycomments'+post_id).val(num);
                            $('.mycomments'+post_id).html( num+' -  Comments' );
                        $('#commentbtn'+post_id).click();
                        $('.textarea'+post_id).val(null);
                        // console.log(response);
                    }else{
                        Swal.fire(
                        'MESSAGE ?',
                        'Can Not Be Empty?',
                        'question'
                        )
                        }
                }
            });
        });
    });
</script>
@endsection