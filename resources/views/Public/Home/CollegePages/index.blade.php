@extends('Public.index')
@section('college_pages')
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
                <!-- <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{$c_p->population}}</h5>
                        <span class="description-text">population</span>
                    </div>
 -->
                <!-- </div> -->
                <div class="col-lg-8 col-sm-4 border-right">
                    <div class="description-block">
                        <p class="description-header">{{$c_p->address}}</p>
                        <span class="description-text"><i class="fas fa-map-marker-alt"></i></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="description-block">
                    <a href="/collegePages/{{$c_p->id}}" class='btn btn-warning'>View Page </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
@endforeach

</div>
@endsection