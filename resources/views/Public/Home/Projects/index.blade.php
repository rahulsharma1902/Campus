@extends('Public.index')
@section('project_pages')


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 mt-3">
            @foreach($allprojects as $ap)
              <a href="{{url('projectgroups')}}/{{$ap->slug}}" class="btn btn-link">{{$ap->group_name}}</a><br>
            @endforeach
        </div>
        <div class="col-lg-10">
          @if($project)
        <div class="card direct-chat direct-chat-primary">
              <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">{{$project['group_name'] ?? ''}}</h3>

                <div class="card-tools">
                  <span title="3 New Messages" class="badge badge-primary">3</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
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
                      <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                    </div>
            
                    @if($m->user_img)
                    <img class="direct-chat-img" src="{{asset('Profile_images')}}/{{$m->user_img}}" alt="message user image">

                        @else
                        <img class="contacts-list-img" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="User Avatar">
                        @endif   
                    <div class="direct-chat-text">
                      {{$m->message}}
                      @if($m->files)
                      <a href="{{asset('projectfile')}}/{{$m->files}}"><i class="far fa-file-pdf" style="font-size:150px;color:green"></i></a>
                      @endif
                    </div>
                   
                  </div>
                  @endforeach
             
                </div>
              

                <!-- Contacts are loaded here -->
                <div class="direct-chat-contacts">
                  <ul class="contacts-list">
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
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
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
<script>
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
        location.reload();
      }
    });
  });
</script>

@endsection