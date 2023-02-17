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
                                            <div class="col-lg-2">
                                                <button class="btn btn-success btn-md sponsorshiprequests"  data-toggle="modal" data-target="#exampleModal{{$ev->id}}" status =0  user-id ="<?php echo Auth::user()->id; ?>" data-id="{{$ev->id}}">Sponsorship Requests</button>
                                              </div>
                                              <div class="col-lg-2">
                                                <button class="btn btn-success btn-md sponsorships" data-toggle="modal" data-target="#exampleModal" status = 1 user-id ="<?php echo Auth::user()->id; ?>" data-id="{{$ev->id}}" >
                                                  Sponsorships active
                                                </button>
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
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Sponsorships</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body sponsors">
                                
                              </div>
                            </div>
                          </div>
                        </div>
<script>



    $(document).ready(function(){
        $('.sponsorshiprequests').click(function(){
            id = $(this).attr('data-id');
            status = $(this).attr('status');
            $.ajax({
                method: 'post',
                url: '{{url('sponsorrequests')}}',
                dataType: 'json',
                data: { _token: '{{csrf_token()}}', id:id, status:0  },
                success: function(response){
                  const bodydata = [];
                    $.each(response, function(key,value){
                     html = '<div class="col-md-12 col-sm-6 col-12"><div class="info-box bg-gradient-warning"><div class="info-box-content"><div class="row"><div class="col-lg-6"><span class="info-box-text">'+value.name+'</span><span class="info-box-number">'+value.email+'</span></div><div class="col-lg-4"><span class="info-box-number">$'+value.amount+'.00</span><span class="info-box-text">'+value.reason+'</span></div><div class="col-lg-2"><a href="{{url('/sponsorrequests/accepted/')}}/'+value.id+'" class="btn btn-success acceptevent" data-id="4"><i class="fas fa-check"></i></a><a href="{{url('/sponsorrequests/denied')}}/'+value.id+'" class="btn btn-danger declineevent" data-id="4"><i class="fas fa-times"></i></a></div></div></div></div></div>';
            //  console.log(html);
                     bodydata.push(html);
                            });
                     $('.sponsorrequests').html(bodydata);
                }

            });
        });
    });

    $(document).ready(function(){
      $('.sponsorships').click(function(e){
        e.preventDefault();
        id = $(this).attr('data-id');
        status = $(this).attr('status');
        userid = $(this).attr('user-id');
        $.ajax({
          method: 'post',
          url: '{{url('sponsorrequests')}}',
          dataType: 'json',
          data: {_token: '{{csrf_token()}}', id:id, status:status, userid:userid},
          success:function(response){
            // console.log(response);
            const divdata = [];
                    $.each(response, function(key,value){
                      // console.log(value);
                     html = '<div class="col-md-12 col-sm-6 col-12"><div class="info-box bg-gradient-warning"><div class="info-box-content"><div class="row"><div class="col-lg-6"><span class="info-box-text">'+value.name+'</span><span class="info-box-number">'+value.email+'</span></div><div class="col-lg-4"><span class="info-box-number">$'+value.amount+'.00</span><span class="info-box-text">'+value.reason+'</span></div></div></div></div></div>';
            //  console.log(html);
                     divdata.push(html);
                            });
                     $('.sponsors').html(divdata);
          }
        })
        
      })
    });
</script>
@endsection