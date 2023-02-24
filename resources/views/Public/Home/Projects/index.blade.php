@extends('Public.index')
@section('project_pages')
<!-- <pre> -->
  <?php 
  // print_r($admin);
  ?>
<!-- </pre> -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 ">
          
            <div class="card">
                    <div class="card-header bg-dark text-light">
                        <div class="row">
                         
                                <div class="col-sm-9 col-xs-9 sideBar-main">
                                    <span>Projects</span>
                                </div>
                        </div> 
                    </div>
                    <div class="card-body" style="height: 35rem; overflow: auto;">
                  @foreach($allprojects as $ap)
                  <a href="{{url('projectgroups')}}/{{$ap->slug}}">
                        <div class="row sideBar-body ">
                        
                            <div class="col-sm-9 col-xs-9 sideBar-main">
                            <div class="row">
                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                <span class="name-meta">{{$ap->group_name}}
                                </span>
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
          @if($project)
        <div class="card direct-chat direct-chat-primary">
              <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">{{$project['group_name'] ?? ''}}</h3>

                <div class="">
                  <span title="3 New Messages" class="badge "></span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    
                  </button>
                  <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                  <i class="fas fa-user-check"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
            
                <div class="direct-chat-messages" style ="display: flex;flex-direction: column-reverse;     height: 480px;">
                <!-- Message. Default to the left -->
                  @foreach($message as $m)
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">{{$m->user_name ?? ''}}</span>
                      <span class="direct-chat-timestamp float-right">{{$m->created_at ?? ''}}</span>
                    </div>
            
                    @if($m->user_img)
                    <img class="direct-chat-img" src="{{asset('Profile_images')}}/{{$m->user_img}}" alt="message user image">

                        @else
                        <img class="contacts-list-img" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="User Avatar">
                        @endif   
                        @if($m->files)
                     
                      <a href="{{asset('projectfile')}}/{{$m->files}}"><i class="far fa-file-pdf" style="font-size:150px;color:green"></i></a>
                 @endif
                    @if($m->message)
                    <div class="direct-chat-text">
                      {{$m->message}}
                    </div>
                    @endif
                   
                  </div>
                  @endforeach
             
                </div>
              

                <!-- Contacts are loaded here -->
                <div class="direct-chat-contacts">
                  <ul class="contacts-list">
                  <li>@if($admin->picture)
                        <img class="contacts-list-img" src="{{url('public/Profile_images/')}}/{{$admin->picture}}" alt="User Avatar">
                        @else
                        <img class="contacts-list-img" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="User Avatar">
                        @endif
                        <div class="contacts-list-info"><h5>Group Admin</h5>
                          <span class="contacts-list-name"> <?php print_r($admin->name); ?></span>
                          <span class="contacts-list-msg"><?php echo $admin->about_me; ?></span>
                          
                        </div>
                    </li>
                  @foreach($userdata as $u)
                    <li>@if($u['picture'])
                        <img class="contacts-list-img" src="{{url('public/Profile_images/')}}/{{$u['picture']}}" alt="User Avatar">
                        @else
                        <img class="contacts-list-img" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="User Avatar">
                        @endif
                        <div class="contacts-list-info">
                          <span class="contacts-list-name"> <?php print_r($u['name']); ?></span>
                          <span class="contacts-list-msg"><?php echo $u['about_me']; ?></span>
                        </div>
                    </li>
               @endforeach
                  </ul>
                  <!-- /.contacts-list -->
                </div>
                <!-- /.direct-chat-pane -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <form action="{{url('projectsmessage')}}" method="post" id ="messageform" enctype= "multipart/form-data"  >
                  @csrf
                  <div class="input-group">
                    <input type="hidden" name="project_id" value="{{$project['id'] ?? ''}}" />
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}" />
                    <input type="text" name="message" id ="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append ">
                    <label for="file" class="m-2"><i class="far fa-file-pdf"></i>
                      </label>
                      <input type="file" id="file" name="file" style="display:none;" />
                    </span>
                    <span class="input-group-append">
                      <button class="btn btn-primary">Send</button>
                    </span>
                  </div>
                </form>
              </div>
              <!-- /.card-footer-->
            </div>
        </div>
        @endif
    </div>
</div>

<!-- <script>
  $('#messageform').on('submit',function(e){
    e.preventDefault();
    formdata = new FormData(this);
    // console.log(formdata);
   
      $.ajax({
			method: 'post',
			url: '{{url('projectsmessage')}}',
      data: formdata,
			dataType: 'json',
      contentType: false,
      processData: false,
			success: function(response)
			{
        console.log(response);
        $('#message').val('');
        $('#file').val('';)

        location.reload();
      }
    });
  });
</script> -->
<script>
  function autoRefresh() {
        $(".direct-chat-messages").load(location.href + " .direct-chat-messages");
        }
        setInterval('autoRefresh()', 5000);
</script>

@endsection