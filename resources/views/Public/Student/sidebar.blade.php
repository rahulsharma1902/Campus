
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <span class="brand-text font-weight-light">
          <img src="{{asset('Profile_images')}}/167714088394.jpg" alt="" style="height:100%; width:100%;"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{url('/student') }}/{{Auth::user()->username}}" class="nav-link {{ (request()->segment(1) == 'student') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i><p>Profile</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i><p>Mailbox</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/calendar')}}" class="nav-link {{ (request()->segment(1) == 'calendar') ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar-check"></i><p>Calendar</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i><p>Political Position</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-star"></i><p>Review</p>
            </a>
          </li>

      </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
