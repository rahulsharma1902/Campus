<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <link rel="stylesheet" href="{{ url('admin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('admin') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('admin') }}/dist/css/adminlte.min.css">
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
        @yield('collegeName')
        @yield('CollegeCourses')
        @yield('CollegeDept')
        @yield('CollegePosition')
        @yield('collegeTemplate')
    </div>
    @include('Admin.Footer')
</body>
<!-- conver text editor to  -->
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
<script>
$('.deletebutton').click(function(e) {
    e.preventDefault();
    id = $(this).attr('data-id');
    $.ajax({
        method: 'post',
        url: '{{url('
        admindash / Colleges / delete ')}}',
        dataType: 'json',
        data: {
            _token: '{{csrf_token()}}',
            id: id
        },
        success: function(response) {
            location.reload();
        }
    });
});
$('.editbutton').click(function(e) {
    e.preventDefault();
    id = $(this).attr('data-id');
    name = $(this).attr('data-name');
    $('#collegeid').val(id);
    $('#collegename').val(name);
});
</script>

<!-- Script of edit and Delete College Course -->
<script>
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
            location.reload();
        }
    });
});
</script>
<!-- Script for  edit or delete departement  -->
<script>
//delete
$('.deletedept').click(function(e) {
    e.preventDefault();
    id = $(this).attr('data-id');
    //  alert(id);
    $.ajax({
        method: 'post',
        url: '{{url('
        admindash / Colleges / deletedept ')}}',
        dataType: 'json',
        data: {
            _token: '{{csrf_token()}}',
            id: id
        },
        success: function(response) {
            location.reload();
        }
    });
});
//edit
$(document).ready(function() {
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
        url: '{{url('
        admindash / Colleges / deleteposition ')}}',
        dataType: 'json',
        data: {
            _token: '{{csrf_token()}}',
            id: id
        },
        success: function(response) {
            location.reload();
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
<!-- script for user type change -->
<Script>
    $('.usertype').change(function(){
       usertype = $(this).val();
        id = $(this).attr('data-id');
        $.ajax({
        method: 'post',
        url: '{{url('/admindash/users/update')}}',
        dataType: 'json',
        data: {_token: '{{csrf_token()}}', id:id, usertype:usertype },
                success: function(response)
                    {
            alert(response);
            
            }
        });
    });
</Script>
</html>