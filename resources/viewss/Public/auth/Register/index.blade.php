@extends('Public.index')
@section('register-content')
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
                <h3 class="card-title">R E G I S T E R</h3>
              </div>
              <div class="card-body">
                <form action="/saveregister" method="get">
                    @csrf
                        <div class="form-group">
                            <label for="real-name">Real Name</label>
                            <input type="text" class="form-control" name='real_name' id="real-name" placeholder="Enter real-name" required>
                        </div>
                        <div class="form-group">
                            <label for="nick-name">Nick Name</label>
                            <input type="text" class="form-control" name='nick_name' id="nick-name" placeholder="Enter nick-name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-Mail-Address</label>
                            <input type="email" class="form-control" name='email' id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="phone-number">Phone Number</label>
                            <input type="phone" class="form-control" name='phone_number' id="phone-number" placeholder="Enter phone" required>
                        </div>
                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <select class="form-control select2 select2-danger select2-hidden-accessible" id='user_type' name="user_type" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                <option selected="selected" value="2" >Student</option>
                                <option value="3">Staff</option>
                                <option value="4">Sponsers</option>
                                <option value="5">Alumni</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" class="form-control"name='username' id="username" aria-describedby="userHelp" placeholder="Enter username" required>
                            <small id="userHelp" class="form-text text-muted">Your username must be unique.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name='password' class="form-control" id="password" placeholder="Enter password" required>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Register</button>
                        </div>
                </form>
              </div>
            </div>
</div></div>
@endsection