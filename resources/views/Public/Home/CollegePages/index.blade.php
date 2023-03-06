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
                <div class="col-sm-6">
                    <div class="description-block">
                    <button class="btn btn-info btn-block btn-sm join" id="join{{$c_p->id}}" data-id="{{$c_p->id}}">JOIN PAGE</button>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="description-block">
                    <a href="/collegepage/{{$c_p->id}}" class='btn btn-warning btn-block btn-sm'>VIEW PAGE</a>
                    </div>
                </div> 
                <div class="d-none"> <button class="useriddbtn" data-id="{{$c_p->id ?? ''}}"><em>join</em></button></div>              
            </div>

        </div>
    </div>

</div>
@endforeach
</div>
<script>
    $(document).ready(function () {
        $('.useriddbtn').trigger('click');
   
        
    });
</script>
<script>
         $('.useriddbtn').on('click', function () {
            var page_id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                method: 'get',
                url: '{{url('/joinflw')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    page_id: page_id,
                },
                success: function(response) {
                    $('#join'+page_id).removeClass('btn-danger');
                    $('#join'+page_id).removeClass('btn-info');
                    if(response[0] == true){
                    if(response[1] == 'UNFOLLOW'){
                        $('#join'+page_id).addClass('btn-danger');
                        $('#join'+page_id).html('UNFOLLOW');
                    }else{
                        $('#join'+page_id).addClass('btn-info');
                        $('#join'+page_id).html('JOIN PAGE');
                    }
                }
                }
            });

        });

</script>
<script>
    $(document).ready(function () {
        $('.join').on('click', function () {
            var page_id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                method: 'get',
                url: '{{url('/join')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    page_id: page_id,
                },
                success: function(response) {
                    $('#join'+page_id).removeClass('btn-danger');
                    $('#join'+page_id).removeClass('btn-info');
                    if(response[0] == true){
                    if(response[1] == 'UNFOLLOW'){
                        console.log(response);
                        Swal.fire({
                                icon: 'success',
                                title: "YOU UNFOLLOW-PAGE",
                                });
                        $('#join'+page_id).addClass('btn-info');
                        $('#join'+page_id).html('JOIN PAGE');
                    }
                    if(response[1] == 'FOLLOW'){
                        console.log(response);
                        Swal.fire({
                                icon: 'success',
                                title: "YOU JOIN-PAGE",
                                });
                        $('#join'+page_id).addClass('btn-danger');
                        $('#join'+page_id).html('UNFOLLOW PAGE');
                    }
                }else{
                    Swal.fire({
                                icon: 'error',
                                title: "Failed To Find Page",
                                });
                }
                }
            });
    });
});
</script>
@endsection