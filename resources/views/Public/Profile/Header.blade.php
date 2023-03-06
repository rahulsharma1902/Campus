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
    <link rel="stylesheet" href="{{asset('')}}/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('')}}/admin/dist/css/adminlte.min.css">
    <script src="{{asset('')}}/admin/plugins/jquery/jquery.min.js"></script>
    <script src="{{asset('')}}/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <link rel="stylesheet" href="{{ asset('admin')}}/plugins/summernote/summernote-bs4.min.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <style type="text/css">
        #map {
  height: 100%; /* The height is 400 pixels */
  width: 100%; /* The width is the width of the web page */
}
    </style>
</head>

<body class="">
    @if ($errors->any())
                                <div class="alert alert-danger" id="success-alert">
                                    @foreach ($errors->all() as $error)
                                     <button type="button" class="close" data-dismiss="alert">x</button>
                                    <li><strong>Error!</strong>{{ $error }}</li> 
                                    @endforeach
                                </div>
                            @endif
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success" id="success-alert">
                                     <button type="button" class="close" data-dismiss="alert">x</button>
                                 <strong>Success!!!</strong>
                                    {{$message}}
                                </div>
                                @endif
                                @if ($message = Session::get('error'))
                                <div class="alert alert-danger" id="danger-alert">
                                     <button type="button" class="close" data-dismiss="alert">x</button>
                                 <strong>Error!</strong>
                                    {{$message}}
                                </div>
                                @endif
    @yield('staff_profile')
    </div>
    <!-- <h3>My Google Maps Demo</h3> -->
    <!--The div element for the map -->
    <!-- <div id="map"></div> -->
    <!-- jQuery -->
    <!-- <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script> -->
    <script type="text/javascript">
    // $(document).ready(function() {
    //     $('.ckeditor').ckeditor();
    // });
    </script>


    <script src="{{asset('')}}/admin/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('')}}/admin/dist/js/demo.js"></script>
    <script src="{{ asset('admin')}}/plugins/summernote/summernote-bs4.min.js"></script>
</body>

</html>