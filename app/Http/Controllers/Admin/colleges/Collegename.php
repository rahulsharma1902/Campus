<?php

namespace App\Http\Controllers\Admin\colleges;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\college_name;
// use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class Collegename extends Controller
{
    //
    public function index(){
            $colleges = college_name::orderBy('college_name', 'asc')->paginate(10);
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
    
    
    
}
