<nav class="main-header navbar navbar-expand navbar-dark ">
<!-- <nav class="main-header navbar navbar-expand navbar-dark " style='position:fixed; width: 100%;'> -->
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/home" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url('projectgroups')}}" class="nav-link">Projects</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/collegePages" class="nav-link">College Pages</a>
        </li>
        @if(Auth::user())
        @if(Auth::user()->user_type == 2 OR Auth::user()->user_type == 3 OR Auth::user()->user_type == 5)
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/groups" class="nav-link">Groups</a>
        </li>
        @endif
        @endif
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/events" class="nav-link">Events</a>
        </li>
        @if(Auth::user())
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/newsfeed" class="nav-link">News Feed</a>
        </li>
        @endif

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        @if (Auth::guest())
        <li class="nav-item">
            <a class="nav-link" href="/register">
                Register
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/login">
                Login
            </a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="/chatmsg">
                <i class="fas fa-sms" title="Chat Now"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/addfriends">
                <i class="fas fa-user-plus"></i>
            </a>
        </li>
        <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown allnotifications">  
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-success navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="myspan" style="width: 25rem;">
          <span class="dropdown-item dropdown-header">Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="/eventrequests" class="dropdown-item">
            <i class="fas fa-calendar-star mr-2"></i> event messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <!-- notifications -->
          <div class="allnotification">
          <!-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            NAME <em> start following you</em>
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          </div> -->
          <!-- End Notifications -->
          <div class="dropdown-divider"></div>
          <a href="/notification" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
        <li class="nav-item">
            <a class="nav-link" href="/profile">
                <i class="fas fa-users-cog"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/logout">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
        @endif

        <!-- </li> -->
    </ul>
</nav>
<script>
    $(document).ready(function () {
        $('.allnotifications').on('click', function () {
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                method: 'get',
                url: '{{url('/allnotifications')}}',
                dataType: 'json',
                data: {
                    _token: token,
                },
                success: function(response) {
                    $('.allnotification').html("");
                //    alert(response);
                //    console.log(response[0][0]->name);
                //    console.log(response[0][0]->name);
                   if(response[1] ==true){
                    for(var i=0;i<response[0].length;i++){
                    $('.allnotification').append('<div class="markread'+response[0][i][0]['id']+'"><div class="dropdown-divider"></div><span class="myspan dropdown-item">'+response[0][i][1]+'<em> - '+ response[0][i][0]['data'] +'</em><span class="float-right text-muted text-sm">3 mins</span></span></div>')
    
                }
                }else{
                    $('.allnotification').append('<div class="dropdown-divider"></div> <span>No New Notification</span>');
                }
            }
            });
        });
    });
</script>
<!-- response[0][i][0]->data  -->