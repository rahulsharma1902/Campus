<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campus</title>


    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('admin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('admin') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('admin') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ url('admin')}}/plugins/toastr/toastr.min.css">
</head>

<body class='sidebar-collapse '>
    @include('Public.Header')

    @yield('register-content')
    @yield('login-content')
    @yield('student_profile')
    @yield('alumni_profile')
    @yield('college_pages')
    @yield('Singlecollege_pages')

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
<script>
    $(document).ready(function() {
        $('.joinpage').on('click', function(e) {
            e.preventDefault()
            var token = $("meta[name='csrf-token']").attr("content");
            var page_id = $(this).attr('data-id')
            // alert('Press Ok to join this page');
            $.ajax({
            method: 'get',
            url: '/joinPage',
            data: {
                _token: token,
                page_id: page_id
            },
            success: function(response) {
                alert(response);
            }
        });
        });
    });
</script>