<!-- Navbar -->
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
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/logout')}}">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
       
        <span class="brand-text font-weight-light text-center">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional)
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="warning">
                <a href="#" class="d-block">{{Auth::user()->real_name}}</a>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{url('/admindash/dashboard') }}"
                        class="nav-link {{ (request()->segment(2) == 'dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <b><p style='color:black;'>
                            Dashboard
                        </p></b>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admindash/dashboard/userrequests')}}"
                        class="nav-link text-{{ (request()->segment(3) == 'userrequests') ? 'info' : '' }}">
                        <i class="fas fa-users nav-icon"></i>
                        <p>User Requests</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admindash/users')}}"
                        class="nav-link text-{{ (request()->segment(2) == 'users') ? 'info' : '' }}">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admindash/Colleges') }}"
                        class="nav-link {{ (request()->segment(2) == 'Colleges') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <b><p style='color:black;'>
                            Colleges
                        </p></b>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{url('admindash/Colleges/name')}}"
                        class="nav-link text-{{ (request()->segment(3) == 'name') ? 'info' : '' }}">
                        <i class=" far fa-circle nav-icon"></i>
                        <p>College Name</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admindash/Colleges/Courses')}}"
                        class="nav-link text-{{ (request()->segment(3) == 'Courses') ? 'info' : '' }}">
                        <i class=" far fa-circle nav-icon"></i>
                        <p>College Course</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admindash/Colleges/Dept')}}"
                        class="nav-link text-{{ (request()->segment(3) == 'Dept') ? 'info' : '' }}">
                        <i class=" far fa-circle nav-icon"></i>
                        <p>College Dept</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admindash/Colleges/Position')}}"
                        class="nav-link text-{{ (request()->segment(3) == 'Position') ? 'info' : '' }}">
                        <i class=" far fa-circle nav-icon"></i>
                        <p>College Positions</p>
                    </a>
                </li>
                <!-- College template -->
                <!-- <li class="nav-item">
                    <a href="{{url('admindash/Template/') }}"
                        class="nav-link {{ (request()->segment(2) == 'Template') ? 'active' : '' }}">
                        <i class="nav-icon  fas fa-university"></i>
                        <b><p style='color:black;'>
                            College Templates
                        </p></b>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admindash/Template/createTemplate')}}"
                        class="nav-link text-{{ (request()->segment(3) == 'createTemplate') ? 'info' : '' }}">
                        <i class=" far fa-circle nav-icon"></i>
                        <p>Create Template</p>
                    </a>
                </li> -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>