@extends('Public.Profile.Header')
@section('staff_profile')
@include('Public.Staff.sidebar')
<section>
    <div class="container col-8">
    <!-- error/success -->
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
    @if ($message = Session::get('error'))
    <div class="dismiss alert alert-danger" id="danger-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>!</strong>
        {{$message}}
    </div>
    @endif
    <!-- end error/success -->

    <div class="container col-12">
        <div class="card card-info mt-3">
            <div class="card-header">
                <h3 class="card-title"><b>C R E A T E - T E M P L A T E</b></h3>
            </div>
            <div class="card-body">
                <form action="{{ url('/updateCollegePage')}}" method='POST'enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$college_page->id ?? ''}}" >
                    <input type="hidden" name="college_id" value="{{$college_page->college_id ?? ''}}">
                    <div class="container col-lg-12">
                        <input type="hidden" name='college_name' id='college_id' value=''>
                        <div class="form-group">
                            <label for="college_name">Name</label>
                            <input type="text" class='form-control' id='college_name' value="{{$college_page->college_name ?? ''}}" name='college_name'>
                        </div>

                        <!-- <div class="form-group">
                            <label for="editor">History</label>
                            <textarea class='ckeditor text-dark' rows="5" value="<?php print_r($college_page->history) ?? ''?>" name="history" cols="50" id="editor"
                                placeholder="History....."></textarea>
                        </div> -->
                        <div class="form-group">
                            <label for="">History</label>
                            <textarea id="summernote" class="summernote" rows="5" name="history" cols="50">
                                <?php print_r($college_page->history) ?? ''?>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class='form-control' value="{{$college_page->address ?? ''}}" name='address' id='address'>
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" class='form-control' value="{{$college_page->type ?? ''}}" name='type' id='type'>
                        </div>


                        <div class="form-group">
                            <label for="admin_contact">Admin Contact</label>
                            <input type="text" class='form-control' value="{{$college_page->admin_contact ?? ''}}" name='admin_contact' id='admin_contact'>
                        </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class='form-control' value="{{$college_page->location ?? ''}}" name='location' id='location'>
                        </div>

                        <div class="form-group">
                            <label for="union_leader">Union Leader</label>
                            <input type="text" class='form-control' value="{{$college_page->union_leader ?? ''}}" name='union_leader' id='union_leader'>
                        </div>


                        <div class="form-group">
                            <label for="images"><a class="btn btn-primary"> College Image</a></label>
                            <input type="file" class='form-control' value="{{$college_page->images ?? ''}}" name='images' id='images' style="display:none;">
                            
                        </div>
                        <div class="form-group">
                            <label for="images">Gallery Images</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" value="{{$college_page->gallery ?? ''}}" name='documents[]' id="exampleInputFile" multiple>
                                <label class="custom-file-label"  for="exampleInputFile">Choose file</label>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="information_editor">Information Section</label>
                            <textarea class='ckeditor text-dark' rows="5" value="<?php print_r($college_page->information_section) ?? ''?>" name="information_section" cols="50" id="information_editor"
                                placeholder="information....."></textarea>
                        </div>  -->
                        <div class="form-group">
                            <label for="">Information Section</label>
                            <textarea id="summernote" class="summernote" rows="5" name="information_section" cols="50">
                                <?php print_r($college_page->information_section) ?? ''?>
                            </textarea>
                        </div>                       
                        <div class="form-group">
                            <button type='submit' class='btn btn-lg btn-dark btn-block'>UPDATE COLLEGE PAGE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    
</section>
<script>
    $(document).ready(function () {
    $('.summernote').summernote();
    });
</script>
@endsection
