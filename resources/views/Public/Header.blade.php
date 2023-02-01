
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
 <!-- Messages Dropdown Menu -->

      @if (Auth::guest())
      <li class="nav-item">
              <a class="nav-link" href="/register" >
                Register
          </a>  </li>
          <li class="nav-item">
              <a class="nav-link" href="/login" >
          Login
          </a>  </li>
          @else
          <li class="nav-item">
              <a class="nav-link" href="/profile">
          <i class="fas fa-users-cog"></i>
          </a>  </li>
          <li class="nav-item">
              <a class="nav-link" href="/logout">
          <i class="fas fa-sign-out-alt"></i>
          </a>  </li>
          @endif
       
  <!-- </li> -->
    </ul>
  </nav>