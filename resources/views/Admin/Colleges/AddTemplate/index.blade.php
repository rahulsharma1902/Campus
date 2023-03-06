@extends('Admin.index')
@section('content')
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

    <div class="container col-12">
        <div class="card card-info mt-3">
            <div class="card-header">
                <h3 class="card-title">Add Colleges</h3>
            </div>
<section>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th style="width: 20px">College-Name</th>
                    <th style="width: 20px">Select-Moderator</th>
                    <th style="width: 20px">Select-Template</th>
                    <th style="width: 20px">Action</th>
                </tr>
            </thead>
            <tbody>
            @for($i=0; $i < count($data); $i++)
                <tr>
                    <td style="width: 10px">#</td>
                    <td style="width: 20px">{{$data[$i]['college_name'] ?? ''}}</td>
                    <td style="width: 20px">
               
                        <select name="" id="" class="form-control moderator{{$data[$i]['id']}}">
                            <option value="0" selected disabled>{{$data[$i]['collegepage']['moderator']['name'] ?? 'SELECT MODERATOR'}}</option>
                            @for($x=0;$x < count($data[$i]['moderators']);$x++)
                                <option value="{{$data[$i]['moderators'][$x]['id'] ?? ''}}">{{$data[$i]['moderators'][$x]['name'] ?? 'No Moderator Found'}}</option>
                            @endfor
                        </select>
                    
                    </td>
                    <td style="width: 20px"><select name="" id="" class="form-control template{{$data[$i]['id']}}">
                    @if($data[$i]['collegepage_count'] == 0)
                        <option value="0" selected disabled>SELECT TEMPLATE</option>
                        @else
                        <option value="{{$data[$i]['collegepage']['template_id']}}" selected disabled>
                            <?php if($data[$i]['collegepage']['template_id'] == 1){ echo "Template One"; }
                            elseif($data[$i]['collegepage']['template_id'] == 2){ echo "Template Two"; } 
                            else{ echo ' SELECT TEMPLATE'; }?>
                        </option>
                       
                        @endif
                        <option value="1">Template 1</option>
                        <option value="2">Template 2</option>
                    </select></td>
                    <th style="width: 20px">
                    @if($data[$i]['collegepage_count'] == 0)
                    <button class="btn btn-info btn-block create-template " data-id="{{$data[$i]['collegepage_count'] ?? ''}}" college-id="{{$data[$i]['id'] ?? ''}}">CREATE TEMPLATE</button></th>
                    @else
                    <button class="btn btn-success btn-block alredygen">Already Genrated</button>
                    @endif
                </tr>
                @endfor 
            </tbody>
        </table>
    </div>
    <div class="d-none"> <button class="useriddbtn" data-id="1">View Image</button></div>  
</section>
<script>
    $(document).ready(function () {
        // $('.useriddbtn').trigger('click');  
        $('.alredygen').on('click', function () {
            Swal.fire({
							  icon: 'warning',
							  title: "Template Already Genrated",
              });
        });   
    });
</script>
    
<script>
    //    $('.useriddbtn').on('click', function () {
    //         alert('clicked');
    //         $('.new').trigger('click');
    //     });

    $(document).ready(function () {
        $('.create-template').on('click', function () {
            // alert($(this).attr('college-id'));
            // var token = $("meta[name='csrf-token']").attr("content");
            var college_id = $(this).attr('college-id');
            var moderator_id = $('.moderator'+college_id).val();
            var template_id = $('.template'+college_id).val();
            // alert(moderator_id);
            // alert(college_id);
            // alert(template_id);
            if(moderator_id == null || template_id == null){
                Swal.fire({
							  icon: 'error',
							  title: "Moderator or Template not selected",
              });
            }else{
                    $.ajax({
                    method: 'get',
                    url: '/templatecreat',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        college_id: college_id,
                        moderator_id:moderator_id,
                        template_id:template_id,
                    },
                    success: function(response) {
                        if(response == true){
                            Swal.fire({
                                icon: 'success',
                                title: "Done To Create Template",
                                });
                                window.location.href = '{{url('/templategen/')}}'+'/'+college_id;
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: "Template Already Exsists",
                                });
                        }
                            // Swal.fire({
                            //     icon: 'success',
                            //     title: response,
                            //     });
                            // alert(response);
                            // console.log(response);
                        }
                });
            }
    });
});
</script>
@endsection