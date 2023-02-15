<?php

namespace App\Http\Controllers\Admin\colleges;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\college_name;
use App\Models\course;
use App\Models\position;
use App\Models\dept;
// use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class CollegePosition extends Controller
{
    //
    public function index(){
        $colleges = college_name::orderBy('college_name', 'asc')->get();
        $positions = \DB::table('positions')
            ->join('college_names', 'positions.college_id', '=', 'college_names.id')
            ->select('positions.*','college_names.college_name')->orderBy('college_id','asc')
            ->paginate(10);
       return view('Admin.Colleges.Position.index', compact('colleges','positions'));

    }
    public function Addposition(Request $request){
        // print_r($request->all());
        $validated = $request->validate([
            'position_name' => 'required',
            'college_id' => 'required|gt:0'    
        ]);
        if($request->id == null){
            $position = new position();
            $position->position_name = $request->position_name;
            $position->college_id = $request->college_id;
            $position->save();
            if($position->save()){
                return redirect('admindash/Colleges/Position')->with('success','successfully added departments');
            }
        }else{
            $position = position::find($request->id);
            $position->position_name = $request->position_name;
            $position->college_id = $request->college_id;
            $position->save();
            if($position->save()){
                return redirect('admindash/Colleges/Position')->with('success','successfully updated departments');
            }
        }
       }
       
       public function deleteposition(Request $request){
        $position = position::find($request->id);
        $position->delete();
        return response()->json('success');
    
       }
}
