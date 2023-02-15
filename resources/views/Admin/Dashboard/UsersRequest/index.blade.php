@extends('Admin.index')
@section('admindashboard')
<section>
    <div class="container col-10 mt-4">
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
                      <th>Request For</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
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
                      <td> <span class="badge bg-success"><?php if($r->user_type == 2){ echo 'student'; }elseif($r->user_type ==3){ echo 'Staff'; }elseif($r->user_type ==4){ echo 'Sponsers'; }elseif($r->user_type ==5){ echo 'Alumni'; } ?></span></td>
                      <td><a href="" class="userapprove" data-id="{{$r->id}}" data-res="1" >
                        <span class="badge bg-success">Approve</span>
                        </a>
                        <a href="" class="userdenied" data-id="{{$r->id}}" data-res="0" >
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
<script>
  $(document).ready(function(){
    $('.userapprove').click(function(e){
      e.preventDefault();
    id = $(this).attr('data-id');
    res = $(this).attr('data-res');
    $.ajax({
        method: 'post',
        url: '{{url('/admindash/dashboard/response')}}',
        dataType: 'json',
        data: {_token: '{{csrf_token()}}', id:id, res:res },
                success: function(response)
                    {
            alert(response);
            location.reload();
            }
        });
    });
  });
  $(document).ready(function(){
    $('.userdenied').click(function(e){
      e.preventDefault();
    id = $(this).attr('data-id');
    res = $(this).attr('data-res');
    $.ajax({
        method: 'post',
        url: '{{url('/admindash/dashboard/response')}}',
        dataType: 'json',
        data: {_token: '{{csrf_token()}}', id:id, res:res },
                success: function(response)
                    {
            alert(response);
            location.reload();
            }
        });
    });
  });
</script>
@endsection