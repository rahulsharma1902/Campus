<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Campus</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    </ul>
    @if (Auth::guest())
    <a href="/login"><button class="btn btn-info my-2 mr-2 my-sm-0">Login</button></a> 
     <a href="/register"><button class="btn btn-warning my-2 my-sm-0">Register</button></a> 
    @else
    <a href="/profile/{{Auth::user()->user_type}}"><button class="btn btn-sm btn-dark my-2 mr-2 my-sm-0"><i class="fas fa-users-cog"></i>Manage Account</button></a> 

    <a href="/logout"><button type="button" class="btn btn-danger btn-block btn-sm"><i class="fas fa-sign-out-alt"></i>Log-Out</button></a>
      @endif
   
  </div>
</nav>