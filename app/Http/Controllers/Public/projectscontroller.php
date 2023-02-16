<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\college_name;
use App\Models\college_page;
use App\Models\alumni_profile;
use App\Models\staff_profile;
use App\Models\student_profile;
use App\Models\joinPage;
use App\Models\User;
use App\Models\post;
use App\Models\group;
use App\Models\message;
use App\Models\event;
use App\Models\event_guest;
use App\Models\sponsership;
use App\Models\project;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class projectscontroller extends Controller
{
    public function index($slug = null){
        // echo $slug;
        if($slug){
            $project = project::where('slug',$slug)->first();
            $users = explode(",",$project['users']);
            foreach($users as $u){
                $userdata[] = student_profile::find($u); 
            }
        }else{
            $project = array();
            $userdata = array();
        }
        $allprojects = project::get();
        return view('Public.Home.Projects.index',compact('allprojects','project','userdata'));
    }
    public function projectgroups($slug = null){
        $projectss = project::where('slug',$slug)->first();
       
        // print_r(Auth::user()->id);
        $teacher = staff_profile::where('user_id',Auth::user()->id)->first();
        $students = student_profile::where('college_id',$teacher->college_id)->get();
        $projects = project::where('created_by',Auth::user()->id)->get();
        return view('Public.Staff.projectgroups',compact('teacher','students','projects','projectss'));
    }
    public function addprojectgroups(Request $request){
        // print_r($request->all());
        $students = implode(",",$request->users);
        // print_r($students);
        if($request->id == null){
    $request->validate([
        'name' => 'required',
        'slug' => 'required|unique:projects',
    ]);

    $project = new project();
    $project->group_name = $request->name;
    $project->slug = $request->slug;
    $project->college_id = $request->college_id;
    $project->created_by = $request->created_by;
    $project->users = $students;
    $project->status = 1;
    $project->save();
    if($project->save()){
        return redirect('/projects')->with('success','successfully created group');
    }else{
        return redirect('/projects')->with('error','something went wrong');
    }
    
        }
        else{
            $project = project::find($request->id);
            $project->group_name = $request->name;
            $project->slug = $request->slug;
            $project->college_id = $request->college_id;
            $project->created_by = $request->created_by;
            $project->users = $students;
            $project->status = 1;
            $project->update();
            if($project->update()){
                return redirect('/projects')->with('success','successfully created group');
            }else{
                return redirect('/projects')->with('error','something went wrong');
            }
        }
        

    }

}