@extends('Public.index')
@section('login-content')
<div class="container my-3">
@if ($message = Session::get('warning'))
        <div class="text-center dismiss alert alert-warning" id="danger-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
              <!-- <strong></strong> -->
            <span class="text-center"><a href="/disabled-account/{{$message}}"><em>Send Request For Unable Your Account</em></a></span>
        </div>
        @endif
</div>
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
                            <label for="user">Username / E-Mail-Address</label>
                            <input type="text" class="form-control"name='user' id="user" placeholder="Enter username or email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name='password' class="form-control" id="password" placeholder="Enter password" required>
                        </div>
                        <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="6LdcyKgkAAAAAD9dDh2p7bDIVc1V2zGZtsd2KIex"></div>
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                    </div>  
                                </div>
                        <div class="form-group">
                             
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Login</button>
                        </div>
                        <div class="text-center">
                          <p>Don't have an account <em><a href="/register">Register</a></em></p>
                        </div>
                </form>
              </div>
            </div>
</div></div>
@endsection