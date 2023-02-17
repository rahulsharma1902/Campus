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
use App\Models\news_feed;
// use Auth;
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class ChatMsgController extends Controller
{
   
    public function index(){
        $friends_id = add_friend::where('user_id',Auth::user()->id)->get('friend_id');
        foreach($friends_id as $fid){
          $f = $fid;
        // $staff[] = staff_profile::where('user_id',$fid)->get();
        // $student[] = student_profile::where('user_id',$fid)->get();
        // $sponsor[] = sponsor_profile::where('user_id',$fid)->get();
        // $alummni[] = alumni_profile::where('user_id',$fid)->get(); 
        }
        print_r($staff);
        // echo '<pre>';
        // print_r($student);
        // echo '</pre>';
        return view('Public.Home.Chatmsg.index');

    }
  
}
