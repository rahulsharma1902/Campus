@extends('Public.index')
@section('register-content')
<div class="container col-lg-8">
<div class="col-md-12">
            <div class="card card-success mt-4">
              <div class="card-header">
                <h3 class="card-title">R E G I S T E R</h3>
              </div>
              <div class="card-body">
                <form action="{{url('/saveregister')}}" method="get">
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
                            <input type="text" class="username form-control"name='username' id="username" aria-describedby="userHelp" placeholder="Enter username" required>
                            <small id="userHelp" class="form-text text-muted">Your username must be unique.</small>
                       <span id="usernname" > </span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name='password' class="form-control" id="password" placeholder="Enter password" required>
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirm-Password</label>
                            <input type="password" name='confirmpassword' class="form-control " id="cpassword" placeholder="Confirm password" required>
                        </div>
                        <div class="form-group">
                             <div class="g-recaptcha" data-sitekey="6LdcyKgkAAAAAD9dDh2p7bDIVc1V2zGZtsd2KIex"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Register</button>
                        </div>
                </form>
              </div>
              <div class="container col-6 text-center mb-2">
               <span> <b>Already have an account </b><a href="/login">login</a></span> 
              </div>
            </div>
</div></div>
<script>
    $(document).ready(function(){
       $('#cpassword').change(function(){
            password = $('#password').val();
            cpassword = $(this).val();
            if(password == cpassword){
               
            }else{
                $(this).val("");
                $(this).html("");
                Swal.fire({
							  icon: 'error',
							  title: "Confirm password not matched!",
              });
            }
       });
    });
    $(document).ready(function(){
        $('#real-name').change(function(){
            var token = $("meta[name='csrf-token']").attr("content");
            str =$(this).val();
            varstr = str.replace(/ /g,'');
            num = '{{rand(1,10000)}}';
            var username = varstr+num;
            // var username = 'rahul';
            // alert(username);
            // console.log(varstr+num);
            // $('#usernname').html('suggest: '+varstr+num);
            // $('#usernname').click(function(){
            //    $('#username').val(varstr+num);
            // });

                $.ajax({
                method: 'get',
                url: '/unique-username',
                data: {
                    _token: token,
                    username: username
                },
                success: function(response) {
                    // alert(response);
                    // console.log(response);
                    if(response[0] == true){
                        $('#usernname').html('suggest: '+username);
                        $('#usernname').click(function(){
                            $('#username').val(username);
                        });   
                    }else{
                        let r = (Math.random() + 1).toString(36).substring(7);
                        // console.log("random", r);
                        newusername = username+r;
                        // console.log(newusername);
                        $('#usernname').html('suggest: '+newusername);
                        $('#usernname').click(function(){
                            $('#username').val(newusername);
                        }); 
                    }
                }
            });
        });
    });
</script>
<!-- Check user name  -->
<script>
    $(document).ready(function(){
        $('.username').on('input', function() {
            // alert($(this).val());
            var token = $("meta[name='csrf-token']").attr("content");
            if($(this).val().length <= 4){
                // alert('more');
                $(this).addClass('is-invalid');
            }else{
                    $(this).removeClass('is-valid');
                    $(this).removeClass('is-invalid');
                    var username = $(this).val();
                    $.ajax({
                    method: 'get',
                    url: '/unique-username',
                    data: {
                        _token: token,
                        username: username
                    },
                    success: function(response) {
                        console.log(response);
                        if(response[0] == true){
                            $('.username').addClass('is-valid');
                        }else{
                            $('.username').addClass('is-invalid');
                        }
                    }
                });
            }

        });

    });
</script>
@endsection