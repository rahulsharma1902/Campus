<?php

namespace App\Http\Controllers\Public\Chatmsg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\college_name;
use App\Models\course;
use App\Models\student_profile;
use App\Models\staff_profile;
use App\Models\sponsor_profile;
use App\Models\alumni_profile;
use App\Models\User;
use App\Models\add_friend;
use App\Models\chatmessage;
use App\Models\news_feed;
// use Auth;
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class ChatMsgController extends Controller
{
   
    public function index($username = null){
        //messagebox
        // print_r($username);
        $user = User::where('username',$username)->first();
        // print_r($user->user_type);
        // die()
        if($user){
        if($user->user_type == 2){
           $userdata = student_profile::where('user_id',$user->id)->join('users','student_profiles.user_id','=','users.id')->select('student_profiles.*','users.username')->first();
        }elseif($user->user_type == 3){
            $userdata = staff_profile::where('user_id',$user->id)->join('users','staff_profiles.user_id','=','users.id')->select('staff_profiles.*','users.username')->first();
        }elseif($user->user_type == 4){
            $userdata = sponsor_profile::where('user_id',$user->id)->join('users','sponsor_profiles.user_id','=','users.id')->select('sponsor_profiles.*','users.username')->first();
        }elseif($user->user_type == 5){
            $userdata = alumni_profile::where('user_id',$user->id)->join('users','alumni_profiles.user_id','=','users.id')->select('alumni_profiles.*','users.username')->first();
        }
    }
        else{
            $userdata = null;
        }
        // print_r($userdata);
        // die();
        //list
        
        $friends_id = add_friend::where('user_id',Auth::user()->id)->get('friend_id');
        foreach($friends_id as $fid){
          $id[] = $fid['friend_id'];
        }
        // print_r($id);
        foreach($id as $i){
           $student[] = student_profile::where('user_id',$i)->join('users','student_profiles.user_id','=','users.id')->select('student_profiles.*','users.username')->get()->toArray();
           $staff[] = staff_profile::where('user_id',$i)->join('users','staff_profiles.user_id','=','users.id')->select('staff_profiles.*','users.username')->get()->toArray();
           $sponsor[] = sponsor_profile::where('user_id',$i)->join('users','sponsor_profiles.user_id','=','users.id')->select('sponsor_profiles.*','users.username')->get()->toArray();
           $alummni[] = alumni_profile::where('user_id',$i)->join('users','alumni_profiles.user_id','=','users.id')->select('alumni_profiles.*','users.username')->get()->toArray();
        }
        $sdata = array();
        foreach($student as $s){
            
            if(count($s) != 0){
              array_push($sdata,$s);
            }
        }$stdata = array(); 
        foreach($staff as $s){
               
            if(count($s) != 0){
                  array_push($stdata,$s);
                }
            }
         $spdata = array();
        foreach($sponsor as $s){
          
                    if(count($s) != 0){
                     array_push($spdata,$s);
                    }
                } 
                 $adata = array();
        foreach($alummni as $s){
          
                        if(count($s) != 0){
                            array_push($adata,$s);
                        }

        }
       
       $data = array_merge($sdata,$stdata,$spdata,$adata);
    //    echo '<pre>';
    //    print_r($data);
    //    echo '</pre>';
    //    die();
        return view('Public.Home.Chatmsg.index',compact('data','userdata'));

    }
    public function sendmessage(Request $request){
        if($request->hasfile('file')){
            $file = $request->file('file');
            $name = time().rand(1,100).'.'.$file->extension();
            $file->move(public_path().'/products_images/', $name);
            $message = new chatmessage();
            $message->message = $request->message;
            $message->media = $name;
            $message->sender_id = $request->sender_id;
            $message->reciever_id = $request->reciever_id;
            $message->save();
            return response()->json('save');
        }else{
            return response()->json('not save');
        }
       

    }
  
}
