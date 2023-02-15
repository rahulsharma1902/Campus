<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campus | User Profile</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('')}}/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('')}}/admin/dist/css/adminlte.min.css">
    <script src="{{url('')}}/admin/plugins/jquery/jquery.min.js"></script>
    <script src="{{url('')}}/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
</head>

<body class="">
    @yield('staff_profile')
    </div>
    <!-- jQuery -->
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
    </script>



    <script src="{{url('')}}/admin/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{url('')}}/admin/dist/js/demo.js"></script>
</body>

</html>