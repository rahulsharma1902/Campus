@extends('Public.index')
@section('chatmsg')
<section>
    <style>
        .avatar-icon img {
            border-radius: 50%;
            height: 49px;
            width: 49px;
        }
        .sideBar-body:hover {
            background-color: #f2f2f2;
            cursor: pointer;
        }
    </style>
    <div class="container-fluid">
        <?php
        //  echo '<pre>'; 
        //  print_r($userdata);
        //  echo '</pre>';
          ?>
        <div class="row mt-3">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <div class="row">
                         
                                <div class="col-sm-9 col-xs-9 sideBar-main">
                                    <span>Users</span>
                                </div>
                        </div> 
                    </div>
                    <div class="card-body" style="height: 30rem; overflow: auto;">
                  @foreach($data as $d)
                  <a href="{{url('chatmsg')}}/{{$d[0]['username']}}">
                        <div class="row sideBar-body ">
                            <div class="col-sm-3 col-xs-3 sideBar-avatar">
                            <div class="avatar-icon">
                                @if($d[0]['picture'])
                                <img src="{{asset('Profile_images')}}/{{$d[0]['picture']}}">
                                @else
                              <img class="contacts-list-img" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="User Avatar">
                              @endif  
                            </div>
                            </div>
                            <div class="col-sm-9 col-xs-9 sideBar-main">
                            <div class="row">
                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                <span class="name-meta"><?php print_r($d[0]['name']); ?>
                                </span>
                                </div>
                                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                              
                                </div>
                            </div>
                            </div>
                        </div>  <hr>
                        </a>
                        @endforeach
                      
                    <!-- End chat with  -->
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
          @if($userdata)
                <div class="card">
                        <div class="card-header  bg-dark text-light">
                        <div class="row">
                            <div class="col-sm-3 col-xs-3 sideBar-avatar">
                                <div class="avatar-icon">
                                    @if($userdata->picture)
                                  <img src="{{asset('Profile_images')}}/{{$userdata->picture}}">
                                  @else
                              <img class="contacts-list-img" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="User Avatar">
                              @endif  
                                </div>
                            </div>
                                <div class="col-sm-9 col-xs-9 sideBar-main">
                                    <span>{{$userdata->name}}</span>
                                </div>
                        </div> 
                        </div>
                        <div class="card-body" id ="messagebox" style="height: 27rem;">
                     
                        <div class="direct-chat-messages" id ="chatbox" style="display: flex;flex-direction: column-reverse; height: 25rem">
                        
                        @foreach($message as $m)
                       
                        <div class="direct-chat-msg <?php if($m['sender_id'] == Auth::user()->id){ echo 'right'; }else{ echo 'left'; } ?>" style="<?php if($m['sender_id'] == Auth::user()->id){ echo 'margin-left:500px; margin-right:0px'; }else{ echo 'margin-right:500px; margin-left:0px'; } ?>" >
                        @if($m['message'])    
                        <div class="direct-chat-text <?php if($m['sender_id'] == Auth::user()->id){ echo 'text-right'; }else{ echo 'text-left'; } ?>" style="margin-left:0px;">
                                {{$m['message']}}
                            </div>
                            @endif
                              @if($m['media']) 
                               <div class="mt-1">
                                    <img src="{{asset('products_images')}}/{{$m['media']}}" alt="" class="img-fluid">
                                </div>@endif
                        </div>
                        @endforeach              
                        </div>
                        <div class="card-footer sticky-footer  bg-dark text-light">
                            <div class="row">
                               
                                <div class="col-lg-11">
                                <form action="{{url('sendmsg')}}" id="form" method="post"  enctype= "multipart/form-data" >
                                    @csrf
                                    <input type="hidden" name="sender_id" value="<?php echo Auth::user()->id; ?>">
                                    <input type="hidden" name="reciever_id" value="<?php echo $userdata->user_id; ?>">
                            <input type="text" name="message" class="form-control">
                            </div>
                            
                            <div class="col-lg-1">
                            <label for="file"> <i class="fas fa-image" style="color:white; "></i></label>
                            <input type="file" name="file" id = "file" style="display:none;">
                            <button class="btn text-success"><i class="fas fa-paper-plane"></i></button>
                            </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>@endif
    </div>
</section>

        <!-- <script>
            $(document).ready(function(){
              $('form').on('submit',function(e){
                e.preventDefault();
                formdata = new FormData(this);
                // console.log(formdata);
                $.ajax({
                    method: 'post',
			        url: '{{url('sendmsg')}}',
                    data: formdata,
			        dataType: 'json',
                    contentType: false,
                    processData: false,
			        success: function(response)
			        {
                    console.log(response);
                   location.reload();
                    }
                });
            });
            });

        </script> -->
       
       <script>
  function autoRefresh() {
        $(".direct-chat-messages").load(location.href + " .direct-chat-messages");
        }
        setInterval('autoRefresh()', 7000);
</script>

@endsection