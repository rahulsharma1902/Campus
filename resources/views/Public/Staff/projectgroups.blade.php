@extends('Public.Profile.Header')
@section('staff_profile')
@include('Public.Staff.sidebar')
<pre>
<?php 
// print_r($teacher); 
// print_r($students);
// print_r($projects);
// print_r($projectss);
?>
</pre>
<div class="container col-6">
        <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Horizontal Form</h3>
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{url('addprojects')}}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Project Name</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="id" value="{{$projectss->id ?? ''}}">
                        <input type="hidden" name="college_id" value="{{$teacher->college_id}}">
                        <input type="hidden" name ="created_by" value="{{$teacher->user_id}}">
                      <input type="text" class="form-control" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)" name="name" value="{{$projectss['group_name'] ?? ''}}" id="name" placeholder="Project Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="slug-text" class="col-sm-2 col-form-label">Slug</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="slug" value="{{$projectss['slug'] ?? ''}}" id="slug-text" placeholder="Project Name">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                   <?php
                   if($projectss){
                    // print_r($projectss['users']);
                   $users = explode(",",$projectss['users']);
                  //  print_r($users);
                   }else{
                    $users = array();
                   }
                   ?>
                    <div class="col-sm-10">
                        <fieldset id = "group1">
                        @foreach($students as $st) 
                      
                        <input type="checkbox" name="users[]" id="user{{$st->id}}" value="{{$st->id}}" <?php if(in_array($st->id,$users)){ echo 'checked'; }else{ echo ''; }  ?> >
                        <label for="inputPassword3" class="col-sm-2 col-form-label">{{$st->name}}</label>
                        @endforeach
                      </select>
                      </fieldset>
                    </div>
                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save</button>
                  <a href="{{url('projects')}}" class="btn btn-info text-end">Add New</a>
                </div>
                <!-- /.card-footer -->
              </form>
        </div>
</div>
</div>
<div class="container">
<table class="table table-bordered datalist">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Group Name</th>
                      <th>Edit</th>
                      <th>Delete</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    @if($projects)
                    <?php $count = 0; ?>
                    @foreach($projects as $p)
                    <tr>
                      <?php $count = $count+1;  ?>
                      <td>{{$count}}</td>
                      <td>{{$p->group_name}}</td>
                      <td>
                    <a href="{{url('projects')}}/{{$p->slug}}">Edit</a>
                      </td>
                      <td>
                    <a href="" data-id ="{{$p->id}}" class="delete">Delete</a>
                      </td>
                    </tr>
                    @endforeach
                    @endif
                    
                  </tbody>
                </table>
</div>
<script>
     function convertToSlug(str){
 str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
             .toLowerCase();

    // trim spaces at start and end of string
    str = str.replace(/^\s+|\s+$/gm,'');
    // alert(str);
    // replace space with dash/hyphen
    str = str.replace(/\s+/g, '-');   
    // document.getElementById("slug-text").innerHTML = str;
    $('#slug-text').val(str);
    //return str;
  }
</script>
<script>
  $(document).ready(function(){
    $('.delete').click(function(e){
      e.preventDefault();
      id = $(this).attr('data-id');
   
     $.ajax({
      method: 'post',
			url: '{{url('deleteproject')}}',
      data: {id:id,_token: '{{csrf_token()}}'},
			dataType: 'json',
			success: function(response){
        Swal.fire({
							  icon: 'error',
							  title: "deleted!",
								text: response  
              }).then((value) => {
              window.location.href = '/projects';
              });
             
      }
     });
    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

@endsection