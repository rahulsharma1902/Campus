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
class StaffOfTheWeekController extends Controller
{
    public function index(){
        if(Auth::user()){
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
            $staff = staff_profile::where('college_id', $collegeid)->get();
            // print_r($students);
            return view('Public.Home.Votes.StaffOfTheWeek',compact('staff'));
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
        $check = DB::table('nominated_staffs')
        ->where('nominate_by',Auth::user()->id)
        ->where('end_date', $request->end_date)
        ->first();
        if($check){
             return redirect()->back()->with('error', 'You are already nominated.');
        }else{
            $nominated_staff = new nominated_staff();
            $nominated_staff->nomination_id = $request->nomenation_id;
            $nominated_staff->college_id = $request->college_id;
            $nominated_staff->why_nominate = $request->why_nominate;
            $nominated_staff->start_date = $request->start_date;
            $nominated_staff->end_date = $request->end_date;
            $nominated_staff->nominate_by = Auth::user()->id;
            $nominated_staff->status = 1;
            $nominated_staff->save();
            return redirect()->back()->with('success', 'You are successfully added.');
        }
    }
    public function getstaffoftheweek(Request $request){
        if(Auth::user()){
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
        $WeekData = DB::table('nominated_staffs')
        ->where('college_id',$collegeid)
        ->where('end_date', $request->end_date)
        ->get()->toarray();
        for($i=0;$i<count($WeekData);$i++){
             $num[] = $WeekData[$i]->nomination_id;    
            }
            $arr_freq = array_count_values($num);    
            arsort($arr_freq);
            $new_arr = array_keys($arr_freq);
           $StaffOfTheWeek =  DB::table('staff_profiles')->where('user_id', $new_arr[0])->first();
        return response()->json([$StaffOfTheWeek]);
    }
}
public function trycode(){
    $WeekData = DB::table('nominated_staffs')
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
       $StudentOfTheWeek =  DB::table('staff_profiles')->where('user_id', $new_arr[0])->first();
       print_r($StudentOfTheWeek);
}
}