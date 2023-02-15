@extends('Public.index')
@section('college_pages')
<div class="row">
@foreach($college_page as $c_p)
<div class="col-md-4 mt-4">
    <div class="card card-widget widget-user">
      <a href="/collegePages/{{$c_p->id}}"> <div class="widget-user-header text-white"
            style="background: url('{{asset('products_images')}}/{{$c_p->images}}') center center;">
            <!-- <h3 class="widget-user-username text-right">Elizabeth Pierce</h3>
            <h5 class="widget-user-desc text-right">Web Designer</h5> -->
        </div></a> 
        <div class="card-body">
        <div class="text-center">
            <h3>{{$c_p->college_name}}</h3>
        </div>
        </div>
        <div class="card-footer">

            <div class="row">
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{$c_p->population}}</h5>
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
                        <button class='btn btn-success joinpage' data-id='{{$c_p->id}}'>Join Page</button>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
@endforeach

</div>
@endsection