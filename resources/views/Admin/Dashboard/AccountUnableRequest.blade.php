@extends('Admin.index')
@section('admindashboard')
<section>
    <div class="container col-11 mt-4">
        <div class="row">
          <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users</h3>

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
                      <th>User-Name</th>
                      <th>Email</th>
                      <th>Reason</th>
                      <th>User Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
             
                  <tbody class="text-center">
                    <?php
                    $count = 0;
                    ?>
                   @foreach($accounts as $account)
                    <tr class="row{{$account['user_id'] ?? ''}}">
                        <td><?php
                        $count = $count+1;
                         echo $count;?></td>
                      <td>{{$account['users']['username']}}</td>
                      <td>{{$account['users']['email']}}</td>
                      <td>{{$account['reason'] ?? ''}}</td>                    
                      <td selected value="{{$account['users']['user_type']}}"><?php if($account['users']['user_type'] == 2){ echo 'student'; }elseif($account['users']['user_type'] ==3){ echo 'Staff'; }elseif($account['users']['user_type'] ==4){ echo 'Sponsers'; }elseif($account['users']['user_type'] ==5){ echo 'Alumni'; } ?></td>
                      <td><button class="active-account btn btn-success btn-sm" data-id="{{$account['user_id'] ?? ''}}">Active Account</button></td>
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
  $(document).ready(function () {
    $('.active-account').on('click', function (e) {
      // alert($(this).data('id'));
      var user_id = $(this).data('id');
      var token = $("meta[name='csrf-token']").attr("content");

      $.ajax({
                method: 'get',
                url: '{{url('/activeAccount')}}',
                dataType: 'json',
                data: {
                    _token: token,
                    user_id: user_id,
                },
                success: function(response) {
                    // alert(response);
                    // console.log(response);
                    if(response[0] == true){
                      $('.row'+user_id).addClass('d-none');
                      alert('Active Account');
                    }else{
                      alert('Failed To Active Acccount');
                    }
                }
            });
    });
  });
</script>
@endsection
 