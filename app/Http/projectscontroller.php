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
use App\Models\projectmessage;
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
            $message = array();
            $users = explode(",",$project['users']);
            foreach($users as $u){
                $userdata[] = student_profile::find($u); 
            }
    $message = projectmessage::where('project_id',$project->id)->orderBy('created_at','desc')->get();

        }else{
            $project = array();
            $userdata = array();
            $message = array();
        }
        $allprojects = project::get();
        return view('Public.Home.Projects.index',compact('allprojects','project','userdata','message'));
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
    public function sendmessage(Request $request){
        $user_type = Auth::user()->user_type;
        if($user_type == 2){
            $userdata = student_profile::where('user_id',Auth::user()->id)->first();
        }if($user_type == 3){
            $userdata = staff_profile::where('user_id',Auth::user()->id)->first();
        }
        
        if($request->hasfile('file')){
            $request->validate([
                'file' => 'mimes:pdf'
            ]);
            $file = $request->file('file');
            $name = time().rand(1,100).'.'.$file->extension();
            $file->move(public_path().'/projectfile/', $name); 
            $message = new projectmessage();
            $message->message = $request->message;
            $message->files = $name;
            $message->user_img = $userdata->picture;
            $message->user_name = $userdata->name;
            $message->project_id = $request->project_id;
            $message->user_id = $request->user_id;
            $message->save();
            return response()->json('done');
        }else{
            if($request->message){
            $message = new projectmessage();
            $message->message = $request->message;
            $message->user_img = $userdata->picture;
            $message->user_name = $userdata->name;
            $message->project_id = $request->project_id;
            $message->user_id = $request->user_id;
            $message->save();
            return response()->json('done');
            }
            else{
                return response()->json('empty');
            }
        }
        


    }

}