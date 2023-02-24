<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\college_name;
use App\Models\alumni_profile;
use App\Models\User;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class AlumniProfile extends Controller
{
    //
    public function index(){
        $college = college_name::all();
        $alumni_profile = alumni_profile::where('user_id', Auth::user()->id)->get();
        return view('Public.Alumni.index',compact('alumni_profile','college'));
    }
    public function save(Request $request){
            if(empty($request->alumni_id)){
                $alumni_profile = new alumni_profile();
                $alumni_profile->name = $request['name'];
                $alumni_profile->about_me = $request['about_me'];
                $alumni_profile->college_graduated_from = $request['college_id'];
                $alumni_profile->social_links = $request['social_links'];
                $alumni_profile->user_id = Auth::user()->id;
                $alumni_profile->save();
                return redirect()->back()->with('success', 'Profile created successfully');
            }else{
                $alumni_profile = alumni_profile::find($request->alumni_id);
                    if($alumni_profile){
                        $alumni_profile->name = $request['name'];
                        $alumni_profile->about_me = $request['about_me'];
                        $alumni_profile->college_graduated_from = $request['college_id'];
                        $alumni_profile->social_links = $request['social_links'];
                        $alumni_profile->user_id = Auth::user()->id;
                        $alumni_profile->save();
                        // return redirect()->back();
                        return redirect()->back()->with('success', 'Profile updated successfully');
                    }
                        return redirect()->back()->with('error', 'Nothing to Update');
            }
      }
      public function profilepicture(Request $request){
        if(!empty($request->alumni_id)){
                if($request->hasfile('profilepic')){
                  $file = $request->file('profilepic');
                 print_r($file);
                  $name = time().rand(1,100).'.'.$file->extension();
                  $file->move(public_path().'/Profile_images/', $name); 
                  $alumni_profile = alumni_profile::find($request->alumni_id);
                  $alumni_profile->picture = $name;
                  $alumni_profile->save();
                  return redirect()->back()->with('success','Profile picture uploaded successfully');
                }
                else{
                  return redirect()->back()->with('error','Select a file to upload profile picture');
                }
            }else{
                return redirect()->back()->with('error', 'Complete Your Student profile Settings');
            }
              }
    }

