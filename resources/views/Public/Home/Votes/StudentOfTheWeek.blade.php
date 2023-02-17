@extends('Public.index')
@section('home')
<section>
    <div class="container col-lg-8">
        <div class="form my-4">
            <form action="/nominatestudent" method="POST">
                @csrf
            <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">SELECT YOUR STUDENT OF THE WEEK</h3>
            </div>
            <div class="card-body">
               <div class="form-group">
                <label for="nomenation_id">I Nomenate</label>
                <select name="nomenation_id" id="nomenation_id" class="form-control">
                    <option value="" selected disabled>I Nomenate</option>
                    @foreach ( $students as $student)
                        <option class="bg-dark" value="{{$student->user_id ?? ''}}">{{$student->name ?? ''}}</option>
                    @endforeach
                </select>
                <input type="hidden" name="college_id" value="{{$student->college_id ?? ''}}">
                <input type="hidden" value="" id="start_date" name="start_date">
                <input type="hidden" value="" id="end_date" name="end_date">
               </div>
               <div class="form-group">
                <label for="why_nominate">Why ? Nominated</label>
                <textarea class="form-control" name="why_nominate" id="why_nominate" cols="30" rows="10"></textarea>
               </div>
               <div class="form-group">
                    <button class="btn btn-dark btn-block">Vote Now</button>
                </div>

            </div>
            </form>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        var curr = new Date; // get current date
        var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
        var last = first + 6; // last day is the first day + 6

        var firstday = new Date(curr.setDate(first)).toUTCString();
        var lastday = new Date(curr.setDate(last)).toUTCString();
        /** Function for conver toUTCString to y-m-d  */
        function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [year, month, day].join('-');
            }
            $('#start_date').val(formatDate(firstday));
            $('#end_date').val(formatDate(lastday));
        console.log(formatDate(firstday));
        console.log(formatDate(lastday));
    });

</script>
@endsection