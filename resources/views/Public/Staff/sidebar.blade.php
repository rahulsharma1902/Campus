<nav class=" navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <?php $user = Auth()->user();

      ?>
       <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <?php if($user !== null){ ?>
            <a href="@if($user->user_type == 3){{url('/staff')}}/{{Auth::user()->username}} @elseif($user->user_type == 4){{url('/sponsor')}}/{{Auth::user()->username}}@endif"
                class="nav-link">Profile</a>
            <?php } ?>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/projects" class="nav-link">Project Add</a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url('/home/pages/')}}" class="nav-link">Pages</a>
        </li> -->
        @php
            $data = App\Models\staff_profile::With('collegepage')->WithCount('moderator')->where('user_id', '=', Auth::User()->id)->first();
            
        @endphp
            @if($data->collegepage)
                <div class="dropdown show">
                    <a class="nav-item btn text-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        College Page
                    </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{url('/addcollegepost')}}">Add College Post</a>
                    @if($data->moderator_count > 0)
                    <a class="dropdown-item" href="{{url('/collegePageUpdate')}}">Update College Page</a>
                    @endif
                </div>
                </div>
            @endif
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Profession</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Mailbox/emailing</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Calendar</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Political Position</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Review</a>
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
            <a class="nav-link" data-slide="true" href="{{url('/logout')}}" role="button"> <i
                    class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>