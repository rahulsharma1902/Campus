@extends('Admin.index')
@section('userrequests')
<section>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Requests</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="max-height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>RealName</th>
                      <th>NickName</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Request For</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $count = 0;
                    ?>
                    @foreach($requests as $r)
                    <tr>
                        <td><?php
                        $count = $count+1;
                         echo $count;?></td>
                      <td>{{$r->real_name}}</td>
                      <td>{{$r->nick_name}}</td>
                      <td>{{$r->email}}</td>
                      <td>{{$r->phone_number}}</td>
                      <td>@if ($r->user_type == 2)
                         <span class='badge bg-success'>Student</span> 
                         @elseif ($r->user_type == 3)
                         <span class='badge bg-warning'>Staff</span>
                         @elseif ($r->user_type == 4)
                         <span class='badge bg-danger'>Sponser</span>
                         @elseif ($r->user_type == 5)
                         <span class='badge bg-info'>Alumni</span>
                      @endif</td>
                      <td><a href="" class="deletebutton">
                        <span class="badge bg-success">Approve</span>
                        </a>
                        <a href="" class="deletebutton" >
                        <span class="badge bg-danger">Denied</span>
                        </a></td>
                    </tr>
                   @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>      
    </div>
</section>
@endsection