<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\college_name;
use App\Models\course;
class StudentProfile extends Controller
{
    //
    public function index(){
        return view('Public.Student.index');
    }
    public function trycode(){
        echo 'hi';
    }
}
