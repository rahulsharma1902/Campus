<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\college_name;
use App\Models\course;
use App\Models\student_profile;
use App\Models\User;
// use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class StudentProfile extends Controller
{
    //
    public function index(){
        $college = college_name::all();
        $course = course::all();
        $student_profile = student_profile::where('user_id', Auth::user()->id)->get();
        return view('Public.Student.index',compact('college','course','student_profile'));
    }
    public function profilepicture(Request $request){
if(!empty($request->student_id)){
        if($request->hasfile('profilepic')){
          $file = $request->file('profilepic');
         print_r($file);
          $name = time().rand(1,100).'.'.$file->extension();
          $file->move(public_path().'/Profile_images/', $name); 
          $student_profile = student_profile::find($request->student_id);
          $student_profile->picture = $name;
          $student_profile->save();
          return redirect()->back()->with('success','Profile picture uploaded successfully');
        }
        else{
          return redirect()->back()->with('error','Select a file to upload profile picture');
        }
    }else{
        return redirect()->back()->with('error', 'Complete Your Student profile Settings');
    }
      }
      public function getCoursesByCollege(Request $request){
        $college_id = $request->college_id;
        $course = course::where('college_id', $request->college_id)->get();
        echo '<option value="0" disabled selected>Choose Course...</option>';
        foreach($course as $cats)
        {
            echo '<option value="'.$cats->id.'">'.$cats->course_name.'</option>';
        }
      }
      public function save(Request $request){
            if(empty($request->student_id)){
                $student_profile = new student_profile();
                $student_profile->name = $request['name'];
                $student_profile->about_me = $request['about_me'];
                $student_profile->college_id = $request['college_id'];
                $student_profile->location = $request['location'];
                $student_profile->course_id = $request['course_id'];
                $student_profile->level = $request['level'];
                $student_profile->authenticate_student = $request['authenticate_student'];
                $student_profile->state_of_origin = $request['state_of_origin'];
                $student_profile->social_links = $request['social_links'];
                $student_profile->user_id = Auth::user()->id;
                $student_profile->save();
                // return redirect()->back();
                return redirect()->back()->with('success', 'Profile created successfully');
            }else{
                $student_profile = student_profile::find($request->student_id);
                    if($student_profile){
                        $student_profile->name = $request['name'];
                        $student_profile->about_me = $request['about_me'];
                        $student_profile->college_id = $request['college_id'];
                        $student_profile->location = $request['location'];
                        $student_profile->course_id = $request['course_id'];
                        $student_profile->level = $request['level'];
                        $student_profile->authenticate_student = $request['authenticate_student'];
                        $student_profile->social_links = $request['social_links'];
                        $student_profile->user_id = Auth::user()->id;
                        $student_profile->save();
                        // return redirect()->back();
                        return redirect()->back()->with('success', 'Profile updated successfully');
                    }

            }
      }
    public function trycode(){
        $college = college_name::all();
        $course = course::all();
        foreach($college as $c){
            $course_id = null;
            $course_name = null;
            $college_id = $c->id;
            $data = \DB::table('courses')->where('college_id',$college_id)
            ->orWhere('college_id','like', $college_id.'%')
            ->orWhere('college_id','like','%'.$college_id.'%')
            ->orwhere('college_id','like','%'.$college_id)->get();
            foreach($data as $d){            
                $course_id[] =  $d->id;
                $course_name[] =  $d->course_name;
                
            }
            $CollegeWithCourse[] = array($c->college_name => array_combine($course_id ?? array(),$course_name ?? array()));        
        }
        echo '<pre>';
        print_r($CollegeWithCourse);
        echo '<pre>';
    }
}
