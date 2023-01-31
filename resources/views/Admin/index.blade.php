<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Campus</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ url('admin') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('admin') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('admin') }}/dist/css/adminlte.min.css">
</head>
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
</div>  
 @include('Admin.Footer')
</body>
<!-- Script for edit and delete of College Name -->
<script>
$('.deletebutton').click(function(e){
  e.preventDefault();
 id = $(this).attr('data-id');
 $.ajax({
   method: 'post',
			url: '{{url('admindash/Colleges/delete')}}',
			dataType: 'json',
      data: {_token: '{{csrf_token()}}', id:id},
			success: function(response)
			{
      location.reload();
      }
 });
});
$('.editbutton').click(function(e){
  e.preventDefault();
  id = $(this).attr('data-id');
  name = $(this).attr('data-name');
 $('#collegeid').val(id);
 $('#collegename').val(name);
});
</script>

<!-- Script of edit and Delete College Course -->
<script>
    $(document).ready(function(){
        $('.editCourse').click(function(e){
            e.preventDefault();
            id = $(this).attr('data-id');
            cid = $(this).attr('college');
            cname = $(this).attr('name');
           $('#courseid').val(id);
           $('#college_id').val(cid);
           $('#coursename').val(cname);
        });
    });
$('.deleteCourse').click(function(e){
  e.preventDefault();
 id = $(this).attr('data-id');
 alert(id);
 $.ajax({
   method: 'post',
			url: '{{url('admindash/Colleges/deletecourse')}}',
			dataType: 'json',
      data: {_token: '{{csrf_token()}}', id:id},
			success: function(response)
			{
      location.reload();
      }
 });
});

</script>
<!-- Script for  edit or delete departement  -->
<script>
    //delete
        $('.deletedept').click(function(e){
        e.preventDefault();
        id = $(this).attr('data-id');
        //  alert(id);
        $.ajax({
        method: 'post',
                    url: '{{url('admindash/Colleges/deletedept')}}',
                    dataType: 'json',
            data: {_token: '{{csrf_token()}}', id:id},
                    success: function(response)
                    {
            location.reload();
            }
        });
    });
    //edit
    $(document).ready(function(){
        $('.editdept').click(function(e){
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
        $('.deleteposition').click(function(e){
        e.preventDefault();
        id = $(this).attr('data-id');
        //  alert(id);
        $.ajax({
        method: 'post',
                    url: '{{url('admindash/Colleges/deleteposition')}}',
                    dataType: 'json',
            data: {_token: '{{csrf_token()}}', id:id},
                    success: function(response)
                    {
            location.reload();
            }
        });
    });
    //edit
    $(document).ready(function(){
        $('.editposition').click(function(e){
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
</html>