@extends('Public.index')
@section('events')
<div class="container">
            <h4>Events</h4>
            @if($myevents)
            @foreach($myevents as $ev)
                      <div class="col-md-12 col-sm-6 col-lg-12">
                            <div class="info-box bg-gradient-warning">
                                <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                                    <div class="info-box-content">
                                        <div class="row">
                                            <div class="col-lg-4">
                                            <span class="info-box-text">{{$ev->event_name}}</span>
                                            <span class="info-box-number">{{$ev->event_date}}{{$ev->event_time}}</span>
                                            </div>
                                            <div class="col-lg-4">
                                                <span class="info-box-number">{{$ev->event_venue}}</span>
                                                <span class="info-box-text">{{$ev->event_guestNumber}}</span>
                                            </div>
                                            <div class="col-lg-4">
                                                <button class="btn btn-success sponsorshiprequests"  data-toggle="modal" data-target="#exampleModal{{$ev->id}}" user-id ="<?php echo Auth::user()->id; ?>" data-id="{{$ev->id}}">Sponsorship Requests</button>
                                            </div>
                                        </div>
                              </div>
                        </div>
                </div>
                        <div class="modal fade" id="exampleModal{{$ev->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Sponsorship Requests</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body sponsorrequests">
                                
                              </div>
                            </div>
                          </div>
                        </div>
                    @endforeach
                    @endif
</div>
<script>
    $(document).ready(function(){
        $('.sponsorshiprequests').click(function(){
            id = $(this).attr('data-id');
            $.ajax({
                method: 'post',
                url: '{{url('sponsorrequests')}}',
                dataType: 'json',
                data: { _token: '{{csrf_token()}}', id:id },
                success: function(response){
                  const bodydata = [];
                    $.each(response, function(key,value){
                     html = '<div class="col-md-12 col-sm-6 col-12"><div class="info-box bg-gradient-warning"><div class="info-box-content"><div class="row"><div class="col-lg-4"><span class="info-box-text">'+value.name+'</span><span class="info-box-number">'+value.email+'</span></div><div class="col-lg-4"><span class="info-box-number">$'+value.amount+'.00</span><span class="info-box-text">'+value.reason+'</span></div><div class="col-lg-4"><a href="{{url('/sponsorrequests/accepted/')}}/'+value.id+'" class="btn btn-success acceptevent" data-id="4"><i class="fas fa-check"></i></a><a href="{{url('/sponsorrequests/denied')}}/'+value.id+'" class="btn btn-danger declineevent" data-id="4"><i class="fas fa-times"></i></a></div></div></div></div></div>';
            //  console.log(html);
            bodydata.push(html);
                   });
            $('.sponsorrequests').append(bodydata);
                }

            });
        });
    });
    $(document).ready(function(){
        $('.acceptevent').click(function(){
            console.log('done');

        })
    });
</script>
@endsection