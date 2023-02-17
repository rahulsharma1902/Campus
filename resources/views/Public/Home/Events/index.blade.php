@extends('Public.index')
@section('events')
    <section>
            @if(Auth::user())
                @if(Auth::user()->user_type == 3)
                   <a href="/createevent" class="btn btn-success my-2">Create Event</a>
                   <a href="/events/myevents" class="btn btn-success my-2">My Events</a> 
                @endif
            @endif
            <div class="container-fluid">
            <h4>Events</h4>
            @if($events)
            @foreach($events as $ev)

                      <div class="col-md-12 col-sm-6 col-lg-12 <?php if(now()->format('Y-m-d')<=$ev[0]->event_date){echo 'd-block';}else{ echo 'd-none';} ?>">
                            <div class="info-box bg-gradient-warning">
                                <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                                    <div class="info-box-content">
                                        <div class="row">
                                            <div class="col-lg-4">
                                            <span class="info-box-text">{{$ev[0]->event_name}}</span>
                                            <span class="info-box-number">{{$ev[0]->event_date}} ({{$ev[0]->event_time}})</span>
                                            </div>
                                            <div class="col-lg-4">
                                                <span class="info-box-number">{{$ev[0]->event_venue}}</span>
                                                <span class="info-box-text">{{$ev[0]->event_guestNumber}}</span>
                                            </div>
                                            <div class="col-lg-4">
                                                <button class="btn btn-success sponsorship"  data-toggle="modal" data-target="#exampleModal{{$ev[0]->id}}" user-id ="<?php echo Auth::user()->id; ?>" data-id="{{$ev[0]->id}}">Give Sponsorship</button>
                                            </div>
                                        </div>
                              </div>
                        </div>
                    </div>                          
<!-- Modal -->
            <div class="modal fade" id="exampleModal{{$ev[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                <form action="{{url('/sponsorrequest')}}" method="post">
                  @csrf
                  <div class="form-group">
                       <label for="name">Name</label>
                       <input type="hidden" name="id" id="testid{{$ev[0]->id}}" value="">
                       <input type="hidden" name="eventid" value="{{$ev[0]->id}}">
                       <input type="hidden" name="userid" value="<?php echo Auth::user()->id; ?>">
                       <input type="hidden" name="hostid" value="{{$ev[0]->event_creator}}">
                       <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                   </div>
                   <div class="form-group">
                       <label for="name">Email</label>
                       <input type="Email" class="form-control" id="email" name = "email" placeholder="Enter your email">
                   </div>
                   <div class="form-group">
                       <label for="name">Phone</label>
                       <input type="number" class="form-control" id="phone" name ="phone" placeholder="Enter your Number">
                   </div>
                   <div class="form-group">
                       <label for="amount">Amount</label>
                       <input type="number" class="form-control" name="amount" id="amount">
                   </div>
                   <div class="form-group">
                       <label for="reason">Why Sponsoring?</label>
                       <input type="text" class="form-control" name="reason" id="reason">
                   </div>
                   <div class="form-group">
                    <button class="btn btn-dark ">Submit</button>
                   </div>
                   </form>
                  </div>
                </div>
              </div>
            </div>
               @endforeach
        @endif
        </div>
    </section>
   <script>
    $(document).ready(function(){
      $('.sponsorship').click(function(){
        id = $ (this).attr('data-id');
        userid = $ (this).attr('user-id');
       $.ajax({
        method: 'post',
        url: '{{url('/getsponsorid')}}',
        dataType: 'json',
        data: {
            _token: '{{csrf_token()}}',
            id: id,
            userid : userid
        },
        success: function(response){
          $('#testid'+id).val(response.id);
          // console.log(response.id);
        }
       });
      
      });
    });
   </script>
@endsection