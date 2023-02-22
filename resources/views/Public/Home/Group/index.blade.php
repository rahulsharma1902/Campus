@extends('Public.index')
@section('groups')
<section>
    <div class="container mb-5">
        <!-- <button class="btn btn-success float-right my-2">CREATE NEW GROUP</button> -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success my-2" data-toggle="modal" data-target="#exampleModal">
            CREATE YOUR GROUP
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">CREATE YOUR GROUP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <form action="{{ url('/addGroup')}}" method="get">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" onload="convertToSlug(this.value)"
                                            onkeyup="convertToSlug(this.value)" name="groupname" id="groupname"
                                            placeholder="Groupname">
                                    </div>
                                </div>
                                <div class="form-group row" style="display:none;">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="slug" id="slug-text"
                                            placeholder="slug">
                                    </div>
                                </div>
                                <hr>
                                <h4 class="text-center">Select Members Form Your Group</h4>
                                <hr>
                                <div class="form-group">
                                    <?php
                                 
                            foreach($addMember as $key => $value){
                                 for($i = 0; $i < count($value); $i++) { ?>
                                    <div class="form-group <?php print_r($value[$i]->id ?? 'hidden') ?>">
                                        <input type="checkbox" name="members[]" class="membercheckbox "
                                            value="<?php print_r($value[$i]->user_id ?? ''); ?>"
                                            id="<?php print_r($value[$i]->id ?? ''); ?>"
                                            <?php if(!empty($value[$i]->user_id)){ if($value[$i]->user_id == Auth::user()->id ){ echo 'text-danger checked required'; }else{ echo '';} }?>
                                            >
                                        <label
                                        class="<?php if(!empty($value[$i]->user_id)){ if($value[$i]->user_id == Auth::user()->id ){ echo 'text-danger'; }else{ echo '';} }?>"
                                            for="<?php print_r($value[$i]->id ?? ''); ?>"><?php print_r($value[$i]->name ?? ''); ?></label>
                                    </div>
                                    <?php  }
                                } ?>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
<div class="container">
  
    <div class="row">
        @if($groupWithMsg)
        @foreach ($groupWithMsg as $c => $p)
 
        @foreach ($p as $groupname => $d )
        <div class="col-lg-4">
            <div class="card card-primary card-outline direct-chat direct-chat-prinary">
                <div class="card-header bg-warning">
                    <h3 class="card-title">{{$groupname ?? ""}}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool deletegrpbtn" data-id="{{$groupname ?? ''}}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <button type="button" class="btn btn-tool getimgbtn" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span>
                        <form action="{{ url('/addgrpmember')}}" method="get">
                            <input type="hidden" value="{{$groupname ?? ''}}" name="groupname">
                                <button type="submit" class="btn btn-tool addusersingrps" data-id="{{$groupname ?? ''}}">
                            <i class="fas fa-user-plus"></i>
                        </button></form></span>
                    </div>
                </div>

                <div class="card-body" style="display: block;">

                    <div class="direct-chat-messages" style="display: flex;flex-direction: column-reverse;">
                        @foreach ($d as $message=>$sendername )
                        <div class="direct-chat-msg <?php if($sendername['name'] == Auth::user()->real_name){echo 'right';}else{ echo "left";} ?>" >
                            <div class="direct-chat-infos clearfix">

                                <span class="direct-chat-name <?php if($sendername['name'] == Auth::user()->real_name){echo 'float-right';}else{ echo "float-left";} ?>">{{$sendername['name'] ?? ""}}</span>
                                <!-- <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span> -->
                            </div>

                            <img class="direct-chat-img" src="{{asset('Profile_images')}}/{{$sendername['image']}}" alt="Message User Image">

                            <div class="direct-chat-text  <?php if($sendername['name'] == Auth::user()->real_name){echo 'bg-danger text-right';}else{ echo "";} ?>" style="<?php if($sendername['name'] == Auth::user()->real_name){echo 'margin-right:50px';} ?>">
                                {{$message ?? ""}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="card-footer" style="display: block;">
                        <form action="#">
                            <div class="input-group">
                              
                                <input type="hidden" name="grpname" value="{{$groupname ?? ''}}"
                                    placeholder="Type Message ..." class="form-control msgbox">
                                <input type="text" name="message" placeholder="Type Message ..."
                                    class="form-control msgbox">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-primary sendmessage"
                                        id="sentbutton">Send</button>
                                </span>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
            @endforeach
            @endforeach
            @endif
    </div>
</div>
</section>
<script>
        // function autoRefresh() {
        //     window.location = window.location.href;
        // }
        // setInterval('autoRefresh()', 5000);
    </script>
<script>
function convertToSlug(str) {
    str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
        .toLowerCase();

    // trim spaces at start and end of string
    str = str.replace(/^\s+|\s+$/gm, '');
    // alert(str);
    // replace space with dash/hyphen
    str = str.replace(/\s+/g, '-');
    // document.getElementById("slug-text").innerHTML = str;
    $('#slug-text').val(str);
    //return str;
}
</script>
<script>
$(document).ready(function() {
    $('.sendmessage').click(function(e) {
        e.preventDefault();
        var message = $(this).closest("div.input-group").find("input[name='message']").val();
        var grpname = $(this).closest("div.input-group").find("input[name='grpname']").val();
        var token = $("meta[name='csrf-token']").attr("content");
        // alert("Message sent from " + grpname + " with message: " + message);
        console.log(message);
        console.log(grpname);

        $.ajax({
            method: 'get',
            url: '{{url('/sendMessage')}}',
            dataType: 'json',
            data: {
                _token: token,
                grpname: grpname,
                message: message
            },
            success: function(response) {
                alert(response);
                location.reload();
                // console.log('done');
            }
        });
    });
});
</script>
<script>
    $(document).ready(function() {
        $('.deletegrpbtn').click(function(e) {
            e.preventDefault();
            alert($(this).attr('data-id'));
            var grpname = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
            method: 'get',
            url: '{{url('/deletegrp')}}',
            dataType: 'json',
            data: {
                _token: token,
                grpname: grpname,
            },
            success: function(response) {
                alert(response);
                location.reload();
                // console.log('done');
            }
        });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.addusersingrp').click(function(e) {
            e.preventDefault();
            alert($(this).attr('data-id'));
            var grpname = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
            method: 'get',
            url: '{{url('/addGrpUser')}}',
            dataType: 'json',
            data: {
                _token: token,
                grpname: grpname,
            },
            success: function(response) {
                alert(response);
                location.reload();
                // console.log('done');
            }
        });
        });
    });
</script>
@endsection