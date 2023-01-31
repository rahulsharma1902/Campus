<?php

namespace App\Http\Controllers\Admin\colleges;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\college_name;
use App\Models\course;
use App\Models\dept;
// use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class CollegeDept extends Controller
{
    //
    public function index(){
        $colleges = college_name::orderBy('college_name', 'asc')->get();
        $dept = \DB::table('depts')
            ->join('college_names', 'depts.college_id', '=', 'college_names.id')
            ->select('depts.*','college_names.college_name')
            ->paginate(10);
    //    return view('Admin.College.AddDepartments')->with('college',$colleges)->with('dept',$dept);
       return view('Admin.Colleges.Dept.index', compact('colleges','dept'));

    }

   public function adddept(Request $request){
    print_r($request->all());
    $validated = $request->validate([
        'dept_name' => 'required',
        'college_id' => 'required|gt:0'    
    ]);
    if($request->id == null){
        $dept = new dept();
        $dept->dept_name = $request->dept_name;
        $dept->college_id = $request->college_id;
        $dept->save();
        if($dept->save()){
            return redirect('admindash/Colleges/Dept')->with('success','successfully added departments');
        }
    }else{
        $dept = dept::find($request->id);
        $dept->dept_name = $request->dept_name;
        $dept->college_id = $request->college_id;
        $dept->save();
        if($dept->save()){
            return redirect('admindash/Colleges/Dept')->with('success','successfully updated departments');
        }
    }
   }
   public function deletedept(Request $request){
    $dept = dept::find($request->id);
    $dept->delete();
    return response()->json('success');

   }

}
