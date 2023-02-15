@extends('Public.index')
@section('events')
<section>
    <div class="container">
        <h4>Events Requests</h4>
        @if(count($event) > 0)
            @foreach( $event as $events )  
                   <div class="col-md-12 col-sm-6 col-12">
                        <div class="info-box bg-gradient-warning">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                                <div class="info-box-content">
                                    <div class="row">
                                        <div class="col-lg-4">
                                        <span class="info-box-text">{{$events->event_name ?? ''}}</span>
                                        <span class="info-box-number">{{$events->event_date ?? ''}}</span>
                                        </div>
                                        <div class="col-lg-4">
                                            <span class="info-box-number">{{$events->event_venue ?? ''}}</span>
                                            <span class="info-box-text">{{$events->event_time ?? ''}}</span>
                                        </div>
                                        <div class="col-lg-4">
                                            <button class="btn btn-success acceptevent" data-id="{{$events->id ?? ''}}"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-danger declineevent"  data-id="{{$events->id ?? ''}}"><i class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>

                        </div>

                    </div>
            @endforeach
            @endif
    </div>
</section>
<script>
    $(document).ready(function () {
        $('.acceptevent').click(function (e) {
            e.preventDefault();
            // alert($(this).data('id'));
            var event_id = $(this).data('id');
            var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                method: 'get',
                url: '{{url('/acceptevent')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    event_id: event_id,
                },
                success: function(response) {
                    alert(response);
                    // location.reload();
                    console.log(response);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.declineevent').click(function (e) {
            e.preventDefault();
            // alert($(this).data('id'));
            var event_id = $(this).data('id');
            var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                method: 'get',
                url: '{{url('/declineevent')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    event_id: event_id,
                },
                success: function(response) {
                    alert(response);
                    location.reload();
                    // console.log(response);
                }
            });
        });
    });
</script>
@endsection