@extends('Admin.index')
@section('collegeName')
<pre>
<?php
// print_r($students);
 ?>
</pre>

<section>
    <div class="card-body">
        <h2>Staff</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th style="width: 40px">Department</th>
                    <th style="width: 40px">Position</th>
                    <th style="width: 40px">College</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; ?>
               @foreach($teachers as $t)
                <tr><?php $count = $count + 1; ?>
                    <td>{{$count}}.</td>
                    <td>{{$t->name}}</td>
                    <td>{{$t->position_name}}</td>
                    <td>{{$t->dept_name}}</td>
                    <td>{{$t->college_name}}</td>
                </tr>
                @endforeach
                {!! $teachers->withQueryString()->links('pagination::bootstrap-5') !!}
            </tbody>
        </table>
    </div>

    <div class="card-body">
        <h1>Students</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th style="width: 40px">Course</th>
                    <th style="width: 40px">College</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; ?>
               @foreach($students as $st)
                <tr><?php $count = $count + 1; ?>
                    <td>{{$count}}.</td>
                    <td>{{$st->name}}</td>
                    <td>{{$st->course_name}}</td>
                    <td>{{$t->college_name}}</td>
                </tr>
                @endforeach
                {!! $students->withQueryString()->links('pagination::bootstrap-5') !!}
            </tbody>
        </table>
    </div>
    <div class="card-body">
        <h3>Alumni's</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th style="width: 40px">College</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; ?>
               @foreach($alumnis as $al)
                <tr><?php $count = $count + 1; ?>
                    <td>{{$count}}.</td>
                    <td>{{$al->name}}</td>
                    <td>{{$al->college_name}}</td>
                </tr>
                @endforeach
                {!! $students->withQueryString()->links('pagination::bootstrap-5') !!}
            </tbody>
        </table>
    </div>
</section>

@endsection