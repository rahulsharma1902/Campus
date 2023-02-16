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
            <a class="nav-link" href="/addfriends">
                <i class="fas fa-user-plus"></i>
            </a>
        </li>
        <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">  
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="/eventrequests" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> event messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
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