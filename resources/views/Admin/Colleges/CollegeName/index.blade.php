@extends('Admin.index')
@section('collegeName')
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
                <h3 class="card-title">Add Colleges</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
              <form class="form-horizontal" method="post" action="/admindash/Colleges/addcolleges">
                @csrf
                  <div class="form-group row ">
              
                    <div class="col-sm-10">
                      <input type="hidden" name="id" value="" id="collegeid"/>
                      <input type="text" class="form-control" id="collegename" name="college_name" placeholder="College Name">
                    </div>
                    <div class="col-sm-2">
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
                      <th>College Name</th>
                      <th style="width: 40px">Edit</th>
                      <th style="width: 40px">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($colleges as $c)
                    <tr>
                      <td>1.</td>
                      <td>{{$c->college_name}}</td>
                      <td>
                          <a href="" class="editbutton" data-id="{{$c->id}}" data-name="{{$c->college_name}}" >
                          <span class="badge bg-warning">edit</span>
                          </a>
                      </td>
                      <td>
                        <a href="" class="deletebutton" data-id="{{$c->id}}">
                        <span class="badge bg-danger">delete</span>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                    {!! $colleges->withQueryString()->links('pagination::bootstrap-5') !!}
                  </tbody>
                </table>
              </div>
   </section>

@endsection