@extends('Admin.index')
@section('CollegeDept')
<section>
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
         <div class="container col-8">
            <div class="card card-info mt-3">
              <div class="card-header">
                <h3 class="card-title">Add Departments</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
              
              <form class="form-horizontal" method="post" action="{{url('admindash/Colleges/Adddept')}}">
                @csrf
                  <div class="form-group row">
                    <div class="col-sm-12">
                     <input type="hidden" name="id" value="" id="deptid"/>
                      <input type="text" class="form-control" id="deptname" name="dept_name" placeholder="Department Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      
                      <select class="form-control select2 select2-danger select2-hidden-accessible" id ="college_id" name="college_id" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                    <option selected="selected" value="0" disabled>Select Your College Name</option>
                    @foreach($colleges as $c)
                    <option value="{{$c->id}}">{{$c->college_name}}</option>
                    @endforeach
                  </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-10">
                      <button class="btn btn-info">Add</button>
                    </div>
                  </div>
              </form>
            </div>
        </div>
       
   </section>
   <section>
   <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Course Name</th>
                      <th>College Name</th>
                      <th style="width: 40px">Edit</th>
                      <th style="width: 40px">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php $count = 0; ?>
                    @foreach($dept as $d)
                    <tr>
                      <td><?php $count = $count+1;
                      echo $count; ?></td>
                      <td>{{$d->dept_name}}</td>
                      <td>{{$d->college_name}}</td>
                      <td>
                          <a href="" class="editdept" data-id="{{$c->id}}" college="{{$d->college_id}}" name="{{$d->dept_name}}" >
                          <span class="badge bg-warning">edit</span>
                          </a>
                      </td>
                      <td>
                        <a href="" class ="deletedept" data-id="{{$d->id}}">
                        <span class="badge bg-danger">delete</span>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
              </div>
   </section>
  
@endsection