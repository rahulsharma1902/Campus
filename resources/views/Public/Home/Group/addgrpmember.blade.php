@extends('Public.index')
@section('groups')
    <section>
<div class="container col-lg-6 my-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary card-outline direct-chat direct-chat-prinary">
                <div class="card-header bg-warning">
                    <h3 class="card-title">{{$group->groupname ?? ""}}</h3>
                    <div class="card-tools">

                    </div>
                </div>
                <div class="card-body" style="display: block;">
               <h4 class="text-center"> Select Your Group Members </h4>
                    <form action="{{ url('/newmembers')}}">
                    <?php  $members = explode(",",$group->group_members); ?>

                        <!-- </select> -->
                        <div class="container">
                        <div class="form-group">
                                    <?php
                            foreach($addMember as $key => $value){
                                 for($i = 0; $i < count($value); $i++) { ?>
                                    <div class="form-group <?php print_r($value[$i]->id ?? 'hidden') ?>">
                                    <input type="hidden" value="{{$group->id ?? ''}}" name="groupid">
                                        <input  type="checkbox" name="members[]" class="membercheckbox "value="<?php print_r($value[$i]->user_id ?? ''); ?>" id="<?php print_r($value[$i]->id ?? ''); ?>"
                                        <?php if(!empty($value[$i]->user_id)){ if($value[$i]->user_id == Auth::user()->id ){ echo ' required'; }else{ echo '';} }?>
                                       <?php
                                        if(!empty($value[$i]->user_id)){
                                            if(in_array($value[$i]->user_id, $members)){
                                                echo 'checked';
                                            }else{
                                                echo '';
                                            }
                                        }
                                        ?>
                                        >
                                        <label
                                        class="<?php if(!empty($value[$i]->user_id)){ if($value[$i]->user_id == Auth::user()->id ){ echo 'text-danger'; }else{ echo '';} }?>"
                                            for="<?php print_r($value[$i]->id ?? ''); ?>"><?php print_r($value[$i]->name ?? ''); ?></label>
                                    </div>
                                    <?php  }
                                } ?>
                                </div>

                                <div class="form-group">
                                    <button type='submit' class="btn btn-success">ADD NEW USERS</button>
                                </div>
                                </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
        </div>
    </section>
@endsection