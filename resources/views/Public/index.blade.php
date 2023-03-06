<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Campus</title>


    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
   
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css')}}">
    <script src="{{ asset('admin')}}/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('admin')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

  <!-- Code for text editor  -->
  <link rel="stylesheet" href="{{ asset('admin')}}/plugins/summernote/summernote-bs4.min.css'}}">
  <!-- End of code of text editor -->
  <!-- Bootstrap 4 -->
  <script src="{{ asset('admin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- Link for story -->
  <link rel="stylesheet" href="{{ asset('coustam.css') }}">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<!-- End Story Links -->

<!-- Script for MAP -->
<script src="https://maps.googleapis.com/maps/api/jskey=AIzaSyAARQsQLsJM2S85cr60Eam3AaaYF98VBpU&libraries=places"  async defer></script>

    <style type="text/css">
        #map {
          height: 400px;
        }
    </style>
 <!-- End Map Script -->
 <!-- script for rechapche -->
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<style>
    .hidden{
        display:none;
    }
</style>
<body class='sidebar-collapse '>

    @include('Public.Header')
    <div class="container mt-5">
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
            <strong><em> Success</em></strong>
            {{$message}}
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="dismiss alert alert-danger" id="danger-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong><em>error</em></strong>
            {{$message}}
        </div>
        @endif

    </div>

    @yield('home')
    @yield('content')
    @yield('register-content')
    @yield('login-content')
    @yield('student_profile')
    @yield('alumni_profile')
    @yield('college_pages')
    @yield('project_pages')
    @yield('Singlecollege_pages')
    @yield('events')
    @yield('groups')
    @yield('newsfeed')
    @yield('addfriends')
    @yield('chatmsg')
    @yield('notification')
    
    <!-- </div> --><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
    @include('Public.Footer')

    
</body>

</html>
<script>
$(document).ready(function() {
    $("select[name='college_id']").on('change', function() {
        var college_id = $("select[name='college_id'] option:selected").val();
        var token = $("meta[name='csrf-token']").attr("content");
        // alert(college_id);
        $.ajax({
            method: 'get',
            url: '/studentprofile/getCoursesByCollege',
            data: {
                _token: token,
                college_id: college_id
            },
            success: function(html) {
                $('#course').html(html);
            }
        });
    });
});
</script>

<!-- Script for Join page -->

<script>
    $(document).ready(function () {
        $('.joinpage').click(function (e) {
            e.preventDefault();
            // alert('Join Page');
            var token = $("meta[name='csrf-token']").attr("content");
            var page_id = $(this).attr("data-id");
            // alert(page_id);
            $.ajax({
            method: 'get',
            url: '/joinPage',
            data: {
                _token: token,
                page_id: page_id
            },
            success: function(response) {
                alert(response);
                window.location.reload();
            }
        });
        });
    });
</script>

<!-- End Script of join page -->
<!-- Script for delete Post -->
<script>
    $(document).ready(function () {
        $('.deletepost').click(function (e) {
            e.preventDefault();
            var token = $("meta[name='csrf-token']").attr("content");
            var post_id = $(this).attr("data-id");
alert(post_id);
            $.ajax({
            method: 'get',
            url: '/deletepost',
            data: {
                _token: token,
                post_id: post_id
            },
            success: function(response) {
                alert(response);
                window.location.reload();
            }
        });

        });
    });
</script>
