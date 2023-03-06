@extends('Public.index')
@section('Singlecollege_pages')
<!-- /.col -->
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

<div class="container mt-5">
    <div class="col-md-12">
    <div class="card card-widget widget-user">
      <div class="widget-user-header text-white"
            style="background: url('{{asset('products_images')}}/{{$SinglePage->images}}') center center;   background-size: cover; height:392px; width: 100%;">
            <!-- <h3 class="widget-user-username text-right">Elizabeth Pierce</h3>
            <h5 class="widget-user-desc text-right">Web Designer</h5> -->
        </div>
        <div class="card-body">
        <div class="text-center">
            <h3>SVGC</h3>
            <div id="followButton">
                @if(count($joinBtn) == 0)
                <!-- if isn't following -->
                <button id="1" name="follow" data-id='{{$SinglePage->id ?? ""}}' class="btn btn-info joinpage">Join</button>
                @else
                <!-- if is following -->
                <button id="1" name="unfollow" data-id='{{$SinglePage->id ?? ""}}' class="btn btn-danger joinpage">Unfollow</button>

            </div>
            @endif
            <!-- <button class='btn btn-success joinpage'  data-id='{{$SinglePage->id ?? ""}}'>Join Page</button> -->
        </div>
        </div>
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#about" data-toggle="tab">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#history" data-toggle="tab">history</a></li>
                    <li class="nav-item"><a class="nav-link" href="#information_section" data-toggle="tab">Information Section</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gallery" data-toggle="tab">Gallery</a></li>
                    @if($staffData)
                    @if($staffData->college_id == $SinglePage->college_id)
                    <li class="nav-item"><a class="nav-link" href="#addPost" data-toggle="tab">Add POST</a></li>
                    @endif
                    @endif
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <!-- About Section -->
                    <div class="active tab-pane" id="about">
                    <div class="row">
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{$SinglePage->population ?? '' }}</h5>
                        <span class="description-text">Students</span>
                    </div>

                </div>
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{count($followers) ?? ''}}</h5>
                        <span class="description-text">FOLLOWERS</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="description-block">
                    <h5 class="description-header">{{Str::upper($SinglePage->union_leader) ?? '' }}</h5>
                        <span class="description-text">Union Leader</span>
                    </div>
                </div>
    </div>
    <hr> 
    <h3 class='text-center'>POSTS</h3>
    <div class="container col-lg-6">
            <div class="row col-lg-12">
                @if($allPosts)
                @foreach($allPosts as $post)
                <div class="card">
                    <div class="card-header">{{$post->description ?? ""}}</div>
                    <div class="card-body">
                        <img src="{{asset('products_images')}}/{{$post->image}}" alt="" style='width: 29rem;'>
                    </div>
                    <div class="card-footer">
                        <span>{{(new Carbon\Carbon($post->created_at))->diffForHumans()}}</span>
                        @if($staffData)
                        @if($post->staff_profile_id == $staffData->id)
                        <button class="btn btn-danger float-right deletepost" data-id="{{$post->id}}"><i class="fas fa-trash-alt"></i></button>
                        @endif
                        @endif
                    </div>
                </div>
                @endforeach
                @else
                <span>--- <i>no post available</i> ---</span>
                @endif
            </div>   
            </div> 
    <!--  -->
           
                    </div>
                    <!-- End About Section -->

                    <!-- History Section -->
                    <div class="tab-pane" id="history">
                        <h1 class='text-center'>History</h1>
                        <div><?php echo $SinglePage->history; ?></div>
                    </div>
                    <!-- end History section -->


                    <!-- Gallery Section -->
                    
                    <div class="tab-pane" id="gallery">
                    <div class="row">
                 <?php   $gallery = explode(",",$SinglePage->Gallery); ?>
                @foreach($gallery as $g)
                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- <a href="#" class="d-block mb-4 h-100"> -->
                            <img class="img-fluid img-thumbnail" src="{{ asset('/products_images')}}/{{$g}}" alt="" style='height: 12rem;'>
                        <!-- </a> -->
                    </div>
                @endforeach
                    </div>
                    </div>
                    <!-- end Gallery section -->

                    <!-- Information Section -->
                    <div class="tab-pane" id="information_section">

                    </div>
                    <!-- End Information section -->
                <!-- Add Post section -->
                    <div class="tab-pane" id="addPost">
                      
                    <form action="{{url('addposts')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="college_page_id" value="{{$SinglePage->id ?? ''}}">
                <input type="hidden" name="staff_profile_id" value="{{$staffData->id ?? ''}}">
                <div class="col-5 mt-5">
                        <div class="form-group mt-1">
                            <input type="text" class="form-control" name="description" >

                        </div>
                        <div class="form-group mt-1">
                                <div class="custom-file">
                                <input type="file" class="custom-file-input" name="postimg" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-dark">Post</button>
                        </div>
                </div>

            </form>
                    </div>
                <!-- End of add post section -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
</div>
@endsection
