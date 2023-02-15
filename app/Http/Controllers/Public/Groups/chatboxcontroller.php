<?php

namespace App\Http\Controllers\Public\Groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\message;
use App\Models\User;
use App\Models\student_profile;
use App\Models\staff_profile;
use App\Models\sponsor_profile;
use App\Models\alumni_profile;
use App\Models\group;
use DB;

class chatboxcontroller extends Controller
{
   public function index(){
    $userid = Auth()->user()->id;
    // print_r($userid);
    $groups = DB::table('groups')->where('group_member','like',$userid.'%')->orWhere('group_member','like','%'.$userid.'%')->orWhere('group_member','like','%'.$userid)->get();     
    $users = User::where('user_type' ,'!=', 1)->get();
    // print_r($users);
    $messages = message::orderBy('created_at','desc')->get();
    $data = array();
    foreach($messages as $m){
        $id = $m->sender_id;
        $usertype = User::where('id',$id)->first()->user_type;
        if($usertype == 2){
            $picture = message::where('messages.id',$m->id)->join('users','messages.sender_id','=','users.id')->join('student_profiles','student_profiles.user_id','=','users.id')->select('messages.*','student_profiles.name','student_profiles.picture')->first();
        }elseif($usertype == 3){
            $picture = message::where('messages.id',$m->id)->join('users','messages.sender_id','=','users.id')->join('staff_profiles','staff_profiles.user_id','=','users.id')->select('messages.*','staff_profiles.name','staff_profiles.picture')->first();
        }elseif($usertype == 4){
            $picture = message::where('messages.id',$m->id)->join('users','messages.sender_id','=','users.id')->join('sponsor_profiles','sponsor_profiles.user_id','=','users.id')->select('messages.*','sponsor_profiles.name','sponsor_profiles.picture')->first();
        }elseif($usertype == 5){
            $picture = message::where('messages.id',$m->id)->join('users','messages.sender_id','=','users.id')->join('alumni_profiles','alumni_profiles.user_id','=','users.id')->select('messages.*','alumni_profiles.name','alumni_profiles.picture')->first();
        }
        array_push($data,$picture);
    }

    return view('Public.Group.chatbox')->with('messages',$data)->with('users',$users)->with('groups',$groups);

   }
   public function sendmessage(Request $request){
    if($request->message){
        $message = new message();
        $message->message = $request->message;
        $message->sender_id = $request->userid;
        $message->group_id = $request->groupid;
        $message->save();
        return response()->json('done');
    }
   }
   public function addgroups(Request $request){
    print_r($request->all());
    $request->validate([
        'groupname' => 'required',
        'slug' => 'required'
    ]);
    $users = implode(',',$request->users);
    // print_r($users);
    $groups = new group();
    $groups->groupname = $request->groupname;
    $groups->slug = $request->slug;
    $groups->group_member = $users;
    $groups->created_by = $request->created_by;
    $groups->save();
       return redirect('Group/Groupname')->with('success','succesfully added groups');

   }

}