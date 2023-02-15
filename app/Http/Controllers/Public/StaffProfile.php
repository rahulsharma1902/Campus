<?php

namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use App\Models\staff_profile;
use App\Models\college_name;


class StaffProfile extends Controller
{
    public function index(){
        $colleges = college_name::get();
        $id = Auth()->id();
        // print_r($id);
        $userdata =  DB::table('staff_profiles')->where('user_id', $id)->join('depts', 'staff_profiles.dept_id', '=', 'depts.id')->join('positions', 'staff_profiles.position_id', '=', 'positions.id')->join('college_names', 'staff_profiles.college_id', '=', 'college_names.id')->select('staff_profiles.*','college_names.college_name','positions.position_name','depts.dept_name')->first();
        
        return view('Public/Staff/index')->with('college',$colleges)->with('userdata',$userdata);
    }
    public function profilephoto(Request $request){
        if($request->hasfile('profilepic')){
            // echo 'done';
            $file = $request->file('profilepic');
            $name = time().rand(1,100).'.'.$file->extension();
            $file->move(public_path().'/Profile_images/', $name); 
            // echo $name;
            $user = DB::table('staff_profiles')->where('user_id', $request->user_id)->first();
            // print_r($user->id);
            if(!empty($user)){
                $staff_profile = Staff_profile::where('user_id', '=',  $request->user_id)->first(); 
                $staff_profile->picture = $name;
                $staff_profile->save();
                return redirect('Staff/profile/')->with('success','image uploaded');
            }
            else{
                $staff_profile = new staff_profile();
                $staff_profile->picture = $name;
                $staff_profile->user_id = $request->user_id;
                $staff_profile->save();
                return redirect('Staff/profile/')->with('success','image uploaded');
            }
          }
     }
     public function AddStaffData(Request $request){
        $user = DB::table('staff_profiles')->where('user_id', $request->id)->first();
        if(!empty($user)){
            $staff_profile = staff_profile::find($user->id);
            $staff_profile->name = $request->name;
            $staff_profile->about_me = $request->about_me;
            $staff_profile->college_id = $request->college_id;
            $staff_profile->location = $request->location;
            $staff_profile->position_id = $request->position_id;
            $staff_profile->dept_id = $request->dept_id;
            $staff_profile->social_links = $request->social_links;
            $staff_profile->user_id = $request->id;
            $staff_profile->save();
            return redirect('Staff/profile')->with('success','successfully updated profile');
        }
        else{
            $staff_profile = new staff_profile();
            $staff_profile->name = $request->name;
            $staff_profile->about_me = $request->about_me;
            $staff_profile->college_id = $request->college_id;
            $staff_profile->location = $request->location;
            $staff_profile->position_id = $request->position_id;
            $staff_profile->dept_id = $request->dept_id;
            $staff_profile->social_links = $request->social_links;
            $staff_profile->user_id = $request->id;
            $staff_profile->save();
            return redirect('Staff/profile')->with('success','successfully updated profile');
        }

     }
     public function getcollegedata(Request $request){
        
        $data = array();
        $dept = DB::table('depts')->where('college_id', $request->id)->get();
        $post = DB::table('positions')->where('college_id', $request->id)->get();
        array_push($data , $dept);
        array_push($data , $post);
        return response()->json($data);
     }
}
