@extends('Public.index')
@section('Singlecollege_pages')
<!-- /.col -->
<div class="container mt-5">
    <div class="col-md-12">
    <div class="card card-widget widget-user">
      <div class="widget-user-header text-white"
            style="background: url('{{asset('products_images')}}/{{$c_p->images}}') center center;   background-size: cover; height:392px; width: 100%;">
            <!-- <h3 class="widget-user-username text-right">Elizabeth Pierce</h3>
            <h5 class="widget-user-desc text-right">Web Designer</h5> -->
        </div>
        <div class="card-body">
        <div class="text-center">
            <h3>SVGC</h3>
            <button class='btn btn-success joinpage'  data-id='{{$SinglePage->id ?? ""}}'>Join Page</button>
        </div>
        </div>
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#about" data-toggle="tab">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#history" data-toggle="tab">history</a></li>
                    <li class="nav-item"><a class="nav-link" href="#information_section" data-toggle="tab">Information Section</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gallery" data-toggle="tab">Gallery</a></li>
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
                        <span class="description-text">population</span>
                    </div>

                </div>
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">13,000</h5>
                        <span class="description-text">FOLLOWERS</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="description-block">
                    <h5 class="description-header">{{$SinglePage->union_leader ?? '' }}</h5>
                        <span class="description-text">Union Leader</span>
                    </div>
                </div>

            </div>
                    </div>
                    <!-- End About Section -->

                    <!-- History Section -->
                    <div class="tab-pane" id="history">
                        <h1 class='text-center'>History</h1>
                        <p><?php echo $SinglePage->history; ?></p>
                    </div>
                    <!-- end History section -->


                    <!-- Gallery Section -->
                    <div class="tab-pane" id="gallery">
                 <?php   $gallery = explode(",",$SinglePage->Gallery); ?>
                @foreach($gallery as $g)
                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid img-thumbnail" src="{{url('/products_images')}}/{{$g}}" alt="">
                        </a>
                    </div>
                @endforeach
                    </div>
                    <!-- end Gallery section -->

                    <!-- Information Section -->
                    <div class="tab-pane" id="information_section">

                    </div>
                    <!-- End Information section -->

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