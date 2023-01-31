@extends('Admin.index')
@section('CollegePosition')
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
              
              <form class="form-horizontal" method="post" action="{{url('admindash/Colleges/Addposition')}}">
                @csrf
                  <div class="form-group row">
                    <div class="col-sm-12">
                     <input type="hidden" name="id" value="" id="positionid"/>
                     <input type="text" class="form-control" id="positionname" name="position_name" placeholder="Position Name">
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
                    @foreach($positions as $p)
                    <tr>
                      <td><?php $count = $count+1;
                      echo $count; ?></td>
                      <td>{{$p->position_name}}</td>
                      <td>{{$p->college_name}}</td>
                      <td>
                          <a href="" class="editposition" data-id="{{$c->id}}" college="{{$p->college_id}}" name="{{$p->position_name}}" >
                          <span class="badge bg-warning">edit</span>
                          </a>
                      </td>
                      <td>
                        <a href="" class ="deleteposition" data-id="{{$p->id}}">
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