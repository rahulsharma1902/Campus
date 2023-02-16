<?php

namespace App\Http\Controllers\Public\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\college_name;
use App\Models\college_page;
use App\Models\alumni_profile;
use App\Models\staff_profile;
use App\Models\student_profile;
use App\Models\User;
use App\Models\nominated_student;
use App\Models\nominated_staff;
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class StudentOfTheWeekController extends Controller
{
    public function index(){
        // $current_time = Carbon::now()->toDayDateTimeString(); // Wed, May 17, 2017 10:42 PM
        // dd($current_time);
        if(Auth::user()){
            // print_r(Auth::user()->user_type);
            if(Auth::user()->user_type == 2){
                $College_id = student_profile::where('user_id', Auth::user()->id)->first();
                $collegeid = $College_id->college_id;
            }
            if (Auth::user()->user_type == 3) {
                $College_id = staff_profile::where('user_id', Auth::user()->id)->first();
                $collegeid = $College_id->college_id;
            } if (Auth::user()->user_type == 5) {
                $College_id = alumni_profile::where('user_id', Auth::user()->id)->first();
                $collegeid = $College_id->college_graduated_from;
            }if(Auth::user()->user_type == 4 || Auth::user()->user_type == 1){
                return redirect()->back()->with('error', 'You are not allowed to access this page.');
            }
            // print_r($collegeid);
            $students = student_profile::where('college_id', $collegeid)->get();
            // print_r($students);
            return view('Public.Home.Votes.StudentOfTheWeek',compact('students'));
        }else{
            return redirect()->back()->with('error', 'You Need To Login First.');
        }
    }
    public function save(Request $request){

        $request->validate([
            'nomenation_id' => 'required',
            'college_id' =>'required',
            'why_nominate' => 'required',
        ]);
        // print_r($request->all());
        $check = DB::table('nominated_students')
        ->where('nominate_by',Auth::user()->id)
        ->where('end_date', $request->end_date)
        ->first();
        // print_r($check);
        if($check){
             return redirect()->back()->with('error', 'You are already nominated.');
        }else{
            $nominated_student = new nominated_student();
            $nominated_student->nomination_id = $request->nomenation_id;
            $nominated_student->college_id = $request->college_id;
            $nominated_student->why_nominate = $request->why_nominate;
            $nominated_student->start_date = $request->start_date;
            $nominated_student->end_date = $request->end_date;
            $nominated_student->nominate_by = Auth::user()->id;
            $nominated_student->status = 1;
            $nominated_student->save();
            return redirect()->back()->with('success', 'You are successfully added.');
        }
    }

    public function getstudentoftheweek(Request $request){
        if(Auth::user()){
            // print_r(Auth::user()->user_type);
            if(Auth::user()->user_type == 2){
                $College_id = student_profile::where('user_id', Auth::user()->id)->first();
                $collegeid = $College_id->college_id;
            }
            if (Auth::user()->user_type == 3) {
                $College_id = staff_profile::where('user_id', Auth::user()->id)->first();
                $collegeid = $College_id->college_id;
            } if (Auth::user()->user_type == 5) {
                $College_id = alumni_profile::where('user_id', Auth::user()->id)->first();
                $collegeid = $College_id->college_graduated_from;
            }if(Auth::user()->user_type == 4 || Auth::user()->user_type == 1){
                return redirect()->back()->with('error', 'You are not allowed to access this page.');
            }
        $WeekData = DB::table('nominated_students')
        ->where('college_id',$collegeid)
        ->where('end_date', $request->end_date)
        ->get()->toarray();
        for($i=0;$i<count($WeekData);$i++){
            $num[] = $WeekData[$i]->nomination_id;    
            }
            $arr_freq = array_count_values($num);    
            arsort($arr_freq);
            $new_arr = array_keys($arr_freq);
           $StudentOfTheWeek =  DB::table('student_profiles')->where('user_id', $new_arr[0])->first();
        return response()->json([$StudentOfTheWeek]);
    }
}
// Code for get Student of the year
public function trycode(){
    $WeekData = DB::table('nominated_students')
        ->select('nomination_id')
        ->where('college_id',6)
        ->where('end_date', "2023-02-18")
        ->get()->toarray();
        echo '<pre>';
        // print_r($WeekData[0]->nomination_id);
        // $data = (array) $WeekData;
        for($i=0;$i<count($WeekData);$i++){
        // print_r($WeekData[$i]->nomination_id);
        $num[] = $WeekData[$i]->nomination_id;

        // var_dump($WeekData[$i]->nomination_id);
        }
        // print_r($num);
        $arr_freq = array_count_values($num);    
        arsort($arr_freq);
        $new_arr = array_keys($arr_freq);
        // print_r($new_arr[0]);
        echo '</pre>';
       $StudentOfTheWeek =  DB::table('student_profiles')->where('user_id', $new_arr[0])->first();
       print_r($StudentOfTheWeek);
}
}