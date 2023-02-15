<?php

namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sponsor_profile;
use App\Models\college_name;
use DB;


class SponsorProfile extends Controller
{
   public function index(){
      $colleges = college_name::get();
      $id = Auth()->id();
      // print_r(id);
      $userdata =  DB::table('sponsor_profiles')->where('user_id', $id)->first();
    return view('Public/Sponsor/index')->with('college',$colleges)->with('userdata',$userdata);
   }
   public function profilephoto(Request $request){
      if($request->hasfile('profilepic')){
         $file = $request->file('profilepic');
         $name = time().rand(1,100).'.'.$file->extension();
         $file->move(public_path().'/products_images/', $name); 
         $user = DB::table('sponsor_profiles')->where('user_id', $request->user_id)->first();
         if(!empty($user)){
            // echo 'done';
             $sponsor_profiles = sponsor_profiles::where('user_id', '=',  $request->user_id)->first(); 
             $sponsor_profiles->picture = $name;
             $sponsor_profiles->save();
             return redirect('/Sponsor/profile')->with('success','image uploaded');
         }
         else{
            // echo 'not done';
             $sponsor_profiles = new sponsor_profile();
             $sponsor_profiles->picture = $name;
             $sponsor_profiles->user_id = $request->user_id;
             $sponsor_profiles->save();
             return redirect('/Sponsor/profile')->with('success','image uploaded');
         }
       }
   }
   public function AddSponsorData(Request $request){
      $user = DB::table('sponsor_profiles')->where('user_id', $request->id)->first();
      // print_r($user->id);
      // print_r($request->all());
      if(!empty($user)){
          $staff_profile = sponsor_profile::find($user->id);
          $staff_profile->name = $request->name;
          $staff_profile->about_me = $request->about_me;
          $staff_profile->social_links = $request->social_links;
          $staff_profile->type_of_support = $request->type_of_support;
          $staff_profile->user_id = $request->id;
          $staff_profile->save();
          return redirect('/Sponsor/profile')->with('success','successfully updated profile');
      }
      else{
          $staff_profile = new sponsor_profile();
          $staff_profile->name = $request->name;
          $staff_profile->about_me = $request->about_me;
          $staff_profile->social_links = $request->social_links;
          $staff_profile->type_of_support = $request->type_of_support;
          $staff_profile->user_id = $request->id;
          $staff_profile->save();
          return redirect('/Sponsor/profile')->with('success','successfully updated profile');
      }
   }
}
