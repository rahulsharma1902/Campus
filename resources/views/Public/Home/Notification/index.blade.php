@extends('Public.index')
@section('notification')
<section>
    <div class="container my-3">
        @foreach($notificationdata as $notification)
        @if($notification[0]->read_at)
        <div class="row  p-2 rounded my-1 bg-dark read{{$notification[0]->id ?? ''}}"> 
            @else
            <div class="row  p-2 rounded my-1 bg-success read{{$notification[0]->id ?? ''}}"> 
            @endif
            <div class="col-lg-2 d-flex justify-content-end"> <h4 class="text-danger">Hi, <em>{{Auth::user()->real_name}} </em> </h4> </div>
            <div class="col-lg-8 d-flex justify-content-start">{{$notification[1]}} {{$notification[0]->Type}} Your Post</div>
            <div class="col-lg-2 d-flex justify-content-end"><button class="markasread btn text-btn" data-id="{{$notification[0]->id}}">Mark as Read</button></div>
        </div>
        @endforeach
    </div>
</section>
<script>
    $(document).ready(function () {
        $('.markasread').on('click', function () {
            var notification_id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                method: 'get',
                url: '{{url('/markasread')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    notification_id: notification_id,
                },
                success: function(response) {
                    if(response){
                        $('.read'+notification_id).removeClass('bg-success').addClass('bg-dark');
                    }
                //    alert(response);
                //    console.log(response);
                }
            });
        });
    });
</script>
@endsection