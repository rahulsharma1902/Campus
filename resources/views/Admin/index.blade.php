<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Campus</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
    <style>
    .ck-content {
        background: #212529 !important;
    }
    </style>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/adminlte.min.css">
    <script src="{{ asset('admin')}}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="{{ asset('admin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<style>
.question:not(.active) {
    display: none;
}
</style>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    @include('Admin.Header')
    <div class="content-wrapper">
        @yield('admindashboard')
        @yield('userrequests')

        @yield('Colleges')
        @yield('content')
        @yield('collegeName')
        @yield('CollegeCourses')
        @yield('CollegeDept')
        @yield('CollegePosition')
        @yield('collegeTemplate')
    </div>
    @include('Admin.Footer')
<script>
ClassicEditor
    .create(document.querySelector('#editor'))
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });
</script>
<script>
ClassicEditor
    .create(document.querySelector('#information_editor'))
    .then(information_editor => {
        console.log(information_editor);
    })
    .catch(error => {
        console.error(error);
    });
</script>
<!-- end -->

<!-- Script for edit and delete of College Name -->


<!-- Script of edit and Delete College Course -->
<script>


    $(document).ready(function(){
    $('.editbutton').click(function(e) {
    e.preventDefault();
    // alert('done');
    id = $(this).attr('data-id');
    name = $(this).attr('data-name');
    $('#collegeid').val(id);
    $('#collegename').val(name);
});
    });
$(document).ready(function(){
    $('.deletebutton').click(function(e) {
    e.preventDefault();
    // alert('hlo');
    // console.log('done');
    id = $(this).attr('data-id');
    $.ajax({
        method: 'post',
        url: '{{url('admindash/Colleges/delete')}}',
        dataType: 'json',
        data: {
            _token: '{{csrf_token()}}',
            id: id
        },
        success: function(response) {
            Swal.fire({
							  icon: 'error',
							  title: "deleted!",
								text: 'college delted successfully' 
              }).then((value) => {
              window.location.href = '{{url('admindash/Colleges/name')}}';
              });
        }
    });
});

});

$(document).ready(function() {
    $('.editCourse').click(function(e) {
        e.preventDefault();
        id = $(this).attr('data-id');
        cid = $(this).attr('college');
        cname = $(this).attr('name');
        $('#courseid').val(id);
        $('#college_id').val(cid);
        $('#coursename').val(cname);
    });
});
$('.deleteCourse').click(function(e) {
    e.preventDefault();
    id = $(this).attr('data-id');
    alert(id);
    $.ajax({
        method: 'post',
        url: '{{url('admindash/Colleges/deletecourse')}}',
        dataType: 'json',
        data: {
            _token: '{{csrf_token()}}',
            id: id
        },
        success: function(response) {
            Swal.fire({
							  icon: 'error',
							  title: "deleted!",
							  text: 'courses deleted successfully'  
              }).then((value) => {
              window.location.href = '{{url('admindash/Colleges/Courses')}}';
              });
        }
    });
});

$(document).ready(function(){
    $('.editdept').click(function(e) {
        e.preventDefault();
        id = $(this).attr('data-id');
        cid = $(this).attr('college');
        cname = $(this).attr('name');
        $('#deptid').val(id);
        $('#college_id').val(cid);
        $('#deptname').val(cname);
    });
});
$(document).ready(function(){
    $('.deletedept').click(function(e) {
    e.preventDefault();
    id = $(this).attr('data-id');
    //  alert(id);
    $.ajax({
        method: 'post',
        url: '{{url('admindash/Colleges/deletedept')}}',
        dataType: 'json',
        data: {
            _token: '{{csrf_token()}}',
            id: id
        },
        success: function(response) {
            Swal.fire({
							  icon: 'error',
							  title: "deleted!",
							  text: 'deleted deapartments successfully'  
              }).then((value) => {
              window.location.href = '{{url('admindash/Colleges/Dept')}}';
              });
        }
    });
});
});

//delete

//edit

</script>
<!-- Script for edit or delete Position -->
<script>
//delete
$('.deleteposition').click(function(e) {
    e.preventDefault();
    id = $(this).attr('data-id');
    //  alert(id);
    $.ajax({
        method: 'post',
        url: '{{url('admindash/Colleges/deleteposition')}}',
        dataType: 'json',
        data: { _token: '{{csrf_token()}}',id: id},
        success: function(response) {
            Swal.fire({
							  icon: 'error',
							  title: "deleted!",
							  text: 'deleted position successfully'  
              }).then((value) => {
              window.location.href = '{{url('admindash/Colleges/Position')}}';
              });
        }
    });
});
//edit
$(document).ready(function() {
    $('.editposition').click(function(e) {
        e.preventDefault();
        id = $(this).attr('data-id');
        cid = $(this).attr('college');
        cname = $(this).attr('name');
        $('#positionid').val(id);
        $('#college_id').val(cid);
        $('#positionname').val(cname);
    });
});
</script>
<!-- Get all Moderator -->
<script>
  $(document).ready(function() {
    $('.addtemplate').click(function(e) {
      e.preventDefault();
      id = $(this).attr('data-id');
      // alert(id);
      $.ajax({
                    method: 'get',
                    url: '{{url('admindash/Colleges/getModerator/')}}',
                    dataType: 'json',
                    data: {
                        _token: '{{csrf_token()}}',
                        college_id: id,
                    },
                    success: function(html) {
                        // $('#selectmoderator').html(html);
                       const divdata = [];
                        $.each(html, function(key, value){
                          option = '<option value="'+value.id+'" >'+value.name+'</option>';
                          // console.log(option);
                          divdata.push(option);
                        })
                        $('.select_moderator'+id).html('<option disabled selected>Select Your Moderator</option>'+divdata);
                      }
                });
    });
  });
</script>

<script>
$(document).ready(function() {
    $('.addtemplate').click(function(e) {
        e.preventDefault();
        id = $(this).attr('data-id');
        $(this).css("display", "none");
        $(".select-moderator" + id).css("display", "block");
        $(".select-moderator" + id).change(function(e) {
            moderator_id = $('.select_moderator'+id).val();
            $(".select-moderator" + id).css("display", "none");
            $(".create_template" + id).css("display", "block");
            $('.createtemplate').click(function(event) {
              event.preventDefault();
                id = $(this).attr('data-id');
                $.ajax({
                    method: 'get',
                    url: '{{url('admindash/Colleges/createTemplate/')}}',
                    dataType: 'json',
                    data: {
                        _token: '{{csrf_token()}}',
                        college_id: id,
                        moderator_id : moderator_id
                    },
                    success: function(response) {
                      alert(JSON.stringify(response));
                    } 
                });
            });
        });
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
</body>
<!-- conver text editor to  -->

</html>