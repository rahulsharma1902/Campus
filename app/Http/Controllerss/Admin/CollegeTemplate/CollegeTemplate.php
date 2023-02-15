<?php

namespace App\Http\Controllers\Admin\CollegeTemplate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\college_name;
use App\Models\college_page;
use App\Models\staff_profile;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class CollegeTemplate extends Controller
{
    //
    public function getModerator(Request $request){
        $college_id = $request->college_id;
        $staff = staff_profile::where('college_id', $college_id)->get();
        // print_r($staff);
        return response()->json($staff);

    }
    public function create(Request $request){
        $college_id = $request["college_id"];
        $moderator_id = $request["moderator_id"];
        if (college_page::where('college_id', $college_id)->exists()) {
            return response()->json(['msg' => 'Page Already Exists']); 
        }else{
        $college_page = new college_page();
        $college_page->college_id = $college_id;
        $college_page->moderator_id = $moderator_id;
        $college_page->status = 0;
        $college_page->save();
        return response()->json(['success' => 'College template Genrate Succefully']); 
        // return Session::flash('success', 'College template Genrate Succefully'.$moderator_id.$college_id);
    } 
    }
    // public function index(Request $request , $id){
    //     $college_id = $id;
    //     $staff_id = staff_profile::where('college_id', $id)->get();
    //     return view('Admin.Colleges.CollegeTemplate.index',compact('college_id','staff_id'));
    // }
    public function createTemplate(Request $request){
        print_r($request->all());
    }
}
