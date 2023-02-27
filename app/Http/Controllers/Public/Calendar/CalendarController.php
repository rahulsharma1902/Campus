<?php

namespace App\Http\Controllers\Public\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{college_name,
                course,
                student_profile,
                User,
                add_friend,
                notification,
                college_page,
                joinPage,
                storie,
};
// use Auth;
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class CalendarController extends Controller
{
   
    public function index(){
        return view('Public.Profile.Calendar.index');
   
    }
}
