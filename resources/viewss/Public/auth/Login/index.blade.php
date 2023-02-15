@extends('Public.index')
@section('login-content')
<div class="container col-lg-8">
<div class="col-md-12">

@if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger mt-2" id="danger-alert">
            
                <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Error!</strong>{{ $error }}
                
            </div>
            @endforeach
        @endif
        @if ($message = Session::get('success'))
                                        <div class="dismiss alert alert-success" id="success-alert">
                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                        <strong>Success!</strong>
                                            {{$message}}
                                        </div>
                                        @endif
                                        <!-- error -->
            @if ($message = Session::get('error'))
                                        <div class="dismiss alert alert-danger" id="danger-alert">
                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                        <strong>!</strong>
                                            {{$message}}
                                        </div>
                                        @endif
            <div class="card card-success mt-4">
              <div class="card-header">
                <h3 class="card-title ">L O G I N</h3>
              </div>
              <div class="card-body">
                <form action="/userlogin" method="get">
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