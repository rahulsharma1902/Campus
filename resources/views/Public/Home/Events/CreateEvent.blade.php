@extends('Public.index')
@section('events')
    <section>
        <div class="container">
            <h3 class="my-2">Create Your Event</h3>
                <form action="{{url('/saveevent')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="event_name">Event Name</label>
                            <input type="text" onload="convertToSlug(this.value)"  onkeyup="convertToSlug(this.value)" id='event_name' name="event_name" value="" class="form-control" placeholder="event name" required>
                    </div>
                    <div class="form-group">
                        <label for="slug-text">Slug</label>
                        <input type="text" id='slug-text' name="slug" value="" class="form-control" placeholder="Slug Name" required>
                    </div>
                    <div class="form-group">
                        <label for="event_date">Date</label>
                        <input type="date" name="event_date" id="event_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="event_time">Time</label>
                        <input type="time" name="event_time" id="event_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="event_venue">Venue</label>
                        <input type="text" name="event_venue" id="event_venue" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sponsership_needed">Sponsership Needed</label>
                            <select name="sponsership_needed" id="sponsership_needed" class="form-control" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="event_cost">Cost</label>
                        <input type="number" min="1" name="event_cost" id="event_cost" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="guest_request">Be Our Guest</label>
                        <Select class='form-control' name="guest_request[]" id="guest_request" multiple required>
                            <option value="" selected disabled>Select College Form Events* </option>
                            @foreach($Colleges as $college)
                                <option value="{{$college->id ?? ''}}">{{$college->college_name ?? ''}}</option>
                            @endforeach
                        </Select>
                    </div>
                    <div class="form-group">
                        <label for="event_guestNumber">Event Guest Number</label>
                        <input type="number" min="1" class="form-control" name="event_guestNumber" id="event_guestNumber" required>
                    </div>
                    <div class="form-group">
                        <button type='submit' class='btn btn-success'>Creat Event Now</button>
                    </div>
                </form>
        </div>
    </section>
    
    <script>
	/* Encode string to slug */
function convertToSlug(str){
    
	//replace all special characters | symbols with a space
	str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
			 .toLowerCase();
	  
	// trim spaces at start and end of string
	str = str.replace(/^\s+|\s+$/gm,'');
	  
	// replace space with dash/hyphen
	str = str.replace(/\s+/g, '-');   
	// document.getElementById("slug-text").innerHTML = str;
	$('#slug-text').val(str);
	//return str;
  }
</script>
@endsection