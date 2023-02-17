@extends('Public.index')
@section('events')
<section>
    <div class="container">
    <hr>

    <hr>
        <h4>Events Requests</h4>
  
        @if(count($event) != 0)
            @foreach( $event as $events )  
                        @if (now()->format('Y-m-d') <= $events[0]->event_date)
                        <h4>Upcoming Ended</h1>
                    @else
                        <h4>Event Ended</h4>
                    @endif
                   <div class="col-md-12 col-sm-6 col-12">
                        <div class="info-box bg-gradient-<?php if(now()->format('Y-m-d') <= $events[0]->event_date){ echo'warning';}else{ echo'danger';} ?>">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                                <div class="info-box-content">
                                    <div class="row">
                                        <div class="col-lg-4">
                                        <span class="info-box-text">{{$events[0]->event_name ?? ''}}</span>
                                        <span class="info-box-number">{{$events[0]->event_date ?? ''}}</span>
                                        </div>
                                        <div class="col-lg-4">
                                            <span class="info-box-number">{{$events[0]->event_venue ?? ''}}</span>
                                            <span class="info-box-text">{{$events[0]->event_time ?? ''}}</span>
                                        </div>
                                        <div class="col-lg-4">
                                            <button class="btn btn-success acceptevent" data-id="{{$events[0]->id ?? ''}}"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-danger declineevent"  data-id="{{$events[0]->id ?? ''}}"><i class="fas fa-times"></i></button>
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
                    location.reload();
                    // console.log(response);
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