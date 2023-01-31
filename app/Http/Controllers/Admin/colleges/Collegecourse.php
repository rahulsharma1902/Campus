<?php

namespace App\Http\Controllers\Admin\colleges;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\college_name;
use App\Models\course;
// use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class Collegecourse extends Controller
{
    //
    public function index(){
        $colleges = college_name::orderBy('college_name', 'asc')->get();
        $courses = \DB::table('courses')
            ->join('college_names', 'courses.college_id', '=', 'college_names.id')
            ->select('courses.*','college_names.college_name')
            ->paginate(10);
        return view('Admin.Colleges.Courses.index', compact('colleges','courses'));
}

public function Addcourses(Request $request){
    $validated = $request->validate([
        'course_name' => 'required',
        'college_id' => 'required|gt:0'    
    ]);

    // print_r($request->course_name);
    if($request->id == null){
        $course = new course();
        $course->course_name = $request->course_name;
        $course->college_id =$request->college_id;
        $course->save();
        if($course->save()){
           return redirect('admindash/Colleges/Courses')->with('success','successfully addedd course');
        }
    }else{
        // print_r($request->college->id);
        $course = course::find($request->id);
        $course->course_name = $request->course_name;
        $course->college_id =$request->college_id;
        $course->save();
        if($course->save()){
        return redirect('admindash/Colleges/Courses')->with('success','successfully addedd course');
         
        }
    }
   }

   public function deletecourses(Request $request){
    $course = course::find($request->id);
    $course->delete();
    return response()->json('success');
   }


}
