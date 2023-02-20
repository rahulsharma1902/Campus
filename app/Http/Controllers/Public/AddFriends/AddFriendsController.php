<?php

namespace App\Http\Controllers\Public\AddFriends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\college_name;
use App\Models\course;
use App\Models\student_profile;
use App\Models\User;
use App\Models\add_friend;
// use Auth;
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class AddFriendsController extends Controller
{
   
    public function index(){
        $users = DB::table('users')->where('user_type','!=', 1)->get();
        return view('Public.Home.AddFriends.index',compact('users'));
   
    }
    public function userimage(Request $request){
        $user = DB::table('users')->where('id','=',$request->user_id)->first();
        $tablename = null;
        if($user->user_type == 2){ $tablename = 'student_profiles'; }
        if($user->user_type == 3){ $tablename = 'staff_profiles'; }
        if($user->user_type == 4){ $tablename = 'sponsor_profiles'; }
        if($user->user_type == 5){ $tablename = 'alumni_profiles'; }
        
        if (DB::table($tablename)->where('user_id', '=', $request->user_id)->exists()) {
            $img = DB::table($tablename)->where('user_id', $request->user_id)->first()->picture;
            if (DB::table('add_friends')->where('user_id', '=', Auth::user()->id)->where('friend_id', '=', $request->user_id)->exists()) {
                $reponse = array($img,"Unfollow");
                return response()->json([$reponse]);
                }else{
                    $reponse = array($img,"Follow");
                    return response()->json([$reponse]);
            }
         }else{
            if (DB::table('add_friends')->where('user_id', '=', Auth::user()->id)->where('friend_id', '=', $request->user_id)->exists()) {
                $img = "167628439519.jpg";
                $reponse = array($img,"Unfollow");
                return response()->json([$reponse]);
                }else{
                    $img = "167628439519.jpg";
                    $reponse = array($img,"Follow");
                    return response()->json([$reponse]);
            }
         }
    }
    // public function trycode(){
    //     $user = DB::table('users')->where('id','=',10)->first();
    //     $tablename = null;
    //     if($user->user_type == 2){ $tablename = 'student_profiles'; }
    //     if($user->user_type == 3){ $tablename = 'staff_profiles'; }
    //     if($user->user_type == 4){ $tablename = 'sponsor_profiles'; }
    //     if($user->user_type == 5){ $tablename = 'alumni_profiles'; }
    //     if (DB::table($tablename)->where('user_id', '=', 10)->exists()) {
    //         $img = DB::table($tablename)->where('user_id', 10)->first()->picture;
    //         return response()->json([$img]);
    //      }else{
    //         return response()->json(["167628439519.jpg"]);
    //      }
    //     // $img = DB::table($tablename)->where('user_id', 10)->first()->picture;
    //     // print_r($img);
    //     // if($img){
    //     //     return response()->json([$img]);
    //     // }else{
    //     //     $img = "11234.jpeg";
    //     //     return response()->json([$img]);
    //     // }
    //     // return response()->json(['ready to go']);
    // }


    public function follow(Request $request){
        if($request){
            if (DB::table('add_friends')->where('user_id', '=', Auth::user()->id)->where('friend_id', '=', $request->friend_id)->exists()) {
                
                DB::table('add_friends')->where('user_id', '=', Auth::user()->id)->where('friend_id', '=', $request->friend_id)->delete();
                return response()->json(false);

             }else{
                    $add_friend = new add_friend();
                    $add_friend->user_id = Auth::user()->id;
                    $add_friend->friend_id = $request->friend_id;
                    $add_friend->status = 1;
                    $add_friend->save();
                    return response()->json([true]);
            }
        }
        
    }

    public function trycode(){
        // $student_profile = User::find(2)->student_profile;
        // echo '<pre>';
        //     dd($student_profile);
        // echo '</pre>';
        $followers = User::find(4)->followers;
        // echo '<pre>';
        //     print_r($followers);
        // echo '</pre>';
        foreach($followers as $follower){
            echo $follower->friend_id;
            echo '<br>';
        }
    }

}
