<?php

namespace App\Http\Controllers\Admin\colleges;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\college_name;
use App\Models\staff_profile;
use App\Models\student_profile;
use App\Models\alumni_profile;
use App\Models\news_feed;
// use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class Collegename extends Controller
{
    //
    public function index(){
            $colleges = college_name::orderBy('college_name', 'asc')->paginate(10);
            // $phone = college_name::find(6)->collegename;
            // dd($phone);
            return view('Admin.Colleges.CollegeName.index', compact('colleges'));
    }
    public function Addcolleges(Request $request){
        $validated = $request->validate([
            'college_name' => 'required|unique:college_names,college_name',    
        ]);
        if($request->id == null){
        $college = new college_name();
        $college->college_name = $request->college_name;
        $college->save();
        if($college->save()){
            return redirect('admindash/Colleges/name')->with('success','successfully added college');
        }
        }
        else{
        // print_r($request->id);
        $collge_name = college_name::find($request->id);
        $collge_name->college_name = $request->college_name;
        $collge_name->save();
        if($collge_name->save()){
            return redirect('admindash/Colleges/name')->with('success','successfully updated college');
        }
        }
       }
       public function Deletecolleges(Request $request){
        $college_name = college_name::find($request->id);
        $college_name->delete();
        return response()->json('success');
    
       }
       public function collegemembers($id){

         $teachers = staff_profile::where('staff_profiles.college_id',$id)->join('positions','positions.id','staff_profiles.position_id')->join('depts','depts.id','staff_profiles.dept_id')->join('college_names','college_names.id','staff_profiles.college_id')->select('staff_profiles.*','positions.position_name','depts.dept_name','college_names.college_name')->paginate(5);
         $students = student_profile::where('student_profiles.college_id',$id)->join('college_names','college_names.id','student_profiles.college_id')->join('courses','courses.id','student_profiles.course_id')->select('student_profiles.*','courses.course_name','college_names.college_name')->paginate(5);
         $alumnis = alumni_profile::where('alumni_profiles.college_graduated_from',$id)->join('college_names','college_names.id','alumni_profiles.college_graduated_from')->select('alumni_profiles.*','college_names.college_name')->paginate(5);

        return view('Admin.Colleges.CollegeName.collegemembers',compact('teachers','students','alumnis'));

       }
    
    
    
}
