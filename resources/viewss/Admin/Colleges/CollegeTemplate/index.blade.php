@extends('Admin.index')
@section('collegeTemplate')
<section>
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
                <h3 class="card-title"><b>C R E A T E - T E M P L A T </b></h3>
            </div>
            <div class="card-body">
                <form action="{{ url('/admindash/Colleges/createTemplate')}}" method='POST'>
                    @csrf
                    <div class="container col-lg-12">
                        <input type="hidden" name='college_id' id='college_id' value='{{$college_id}}'>
                        <div class="form-group">
                            <label for="college_name">Name</label>
                            <input type="text" class='form-control' id='college_name' name='college_name'>
                        </div>

                        <div class="form-group">
                            <label for="editor">History</label>
                            <textarea class='text-dark' rows="5" name="history" cols="50" id="editor"
                                placeholder="History....."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class='form-control' name='address' id='address'>
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" class='form-control' name='type' id='type'>
                        </div>


                        <div class="form-group">
                            <label for="admin_contact">Admin Contact</label>
                            <input type="text" class='form-control' name='admin_contact' id='admin_contact'>
                        </div>

                        <div class="form-group">
                            <label for="school_management">School Managment</label>
                            <input type="text" class='form-control' name='school_management' id='school_management'>
                        </div>


                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class='form-control' name='location' id='location'>
                        </div>


                        <div class="form-group">
                            <label for="population">Population</label>
                            <input type="text" class='form-control' name='population' id='population'>
                        </div>


                        <div class="form-group">
                            <label for="faculties">Faculties</label>
                            <input type="text" class='form-control' name='faculties' id='faculties'>
                        </div>


                        <div class="form-group">
                            <label for="union_leader">Union Leader</label>
                            <input type="text" class='form-control' name='union_leader' id='union_leader'>
                        </div>


                        <div class="form-group">
                            <label for="images">Images</label>
                            <input type="text" class='form-control' name='images' id='images'>
                        </div>

                        <div class="form-group">
                            <label for="information_editor">Information Section</label>
                            <textarea class='text-dark' rows="5" name="information_section" cols="50" id="information_editor"
                                placeholder="information....."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="review">Review</label>
                            <input type="text" class='form-control' name='review' id='review'>
                        </div>


                        <div class="form-group">
                            <label for="moderator">Select Moderator</label>
                            <select name="moderator_id" id="moderator" class='form-control'>
                                <option value="" disabled selected>Select a Moderator</option>
                                @foreach ($staff_id as $s_i)
                                <option value="{{$s_i->id}}">{{$s_i->name}}</option>
                                @endforeach
                            </select>
                            <!-- <label for="">Moderator</label>
                                <input type="text" class='form-control'> -->
                        </div>
                        <div class="form-group">
                            <button type='submit' class='btn btn-lg btn-outline-dark btn-block'>Create Template</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection