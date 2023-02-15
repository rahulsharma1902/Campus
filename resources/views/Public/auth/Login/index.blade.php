@extends('Public.index')
@section('login-content')
<div class="container col-lg-8">
<div class="col-md-12">
            <div class="card card-success mt-4">
              <div class="card-header">
                <h3 class="card-title ">L O G I N</h3>
              </div>
              <div class="card-body">
                <form action="{{url('/userlogin')}}" method="get">
                    @csrf
    
                        <div class="form-group">
                            <label for="user">User Name / E-Mail-Address</label>
                            <input type="text" class="form-control"name='user' id="user" placeholder="Enter username or email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name='password' class="form-control" id="password" placeholder="Enter password" required>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Login</button>
                        </div>
                </form>
              </div>
            </div>
</div></div>
@endsection