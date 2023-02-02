@extends('Admin.index')
@section('admindashboard')
<section>
    <div class="container col-11 mt-4">
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
                  <thead class="text-center">
                    <tr>
                      <th>ID</th>
                      <th>RealName</th>
                      <th>NickName</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>User Type</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $count = 0;
                    ?>
                   @foreach($user as $u)
                    <tr>
                        <td><?php
                        $count = $count+1;
                         echo $count;?></td>
                      <td>{{$u->real_name}}</td>
                      <td>{{$u->nick_name}}</td>
                      <td>{{$u->email}}</td>
                      <td>{{$u->phone_number}}</td>                    
                    <td>
                    <select class="usertype custom-select form-control-border border-width-2" id="usertype" data-id={{$u->id}}>
                    <option selected value="{{$u->usertype}}"><?php if($u->user_type == 2){ echo 'student'; }elseif($u->user_type ==3){ echo 'Staff'; }elseif($u->user_type ==4){ echo 'Sponsers'; }elseif($u->user_type ==5){ echo 'Alumni'; } ?></option>
                    <option value="2" >Student</option>
                    <option value="3">Staff</option>
                    <option value="5">Alumni</option>
                    <option value="4">Sponsors</option>
                  </select>
                    </td>
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
@endsection
 