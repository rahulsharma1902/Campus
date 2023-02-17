<?php

namespace App\Http\Controllers\Public\NewsFeed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\college_name;
use App\Models\course;
use App\Models\student_profile;
use App\Models\User;
use App\Models\add_friend;
use App\Models\news_feed;
// use Auth;
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class NewsFeedController extends Controller
{
   
    public function index(){
        if(DB::table('add_friends')->where('user_id', '=', Auth::user()->id)->exists()){
        $followuser = DB::table('add_friends')->where('user_id',Auth::user()->id)->get(['friend_id'])->toArray();
        // print_r(count($followuser));  die();
        foreach($followuser as $key=>$value){
            // print_r($value->friend_id);
            $followPOST[] = DB::table('news_feeds')->where('upload_by',$value->friend_id)->get()->toArray();
            // echo '<pre>';
            // print_r($followPOST);
            // echo '</pre>';
        }
        // echo '<pre>';
        // print_r($followPOST);
        // echo '</pre>';
        // die();
        // foreach($followPOST as $key=>$value){
        //     echo '<pre>';
        //     print_r(count($value));
        //     if(count($value) != 0){
        //         for($i = 0; $i < count($value); $i++){
        //             print_r($value[$i]->post_title);
        //         }
        //     }
        //     echo '</pre>';
        // }
        // die();
        // $posts = news_feed::orderBy('created_at','desc')->paginate(10);
        return view('Public.Home.NewsFeed.index',compact('followPOST'));
    }else{
        $followPOST = array();
        // print_r(count($followPOST));
        // die();
        return view('Public.Home.NewsFeed.index',compact('followPOST'));
    }
    }
    public function uploadpost(Request $request){
        // print_r($request->all());
        $request->validate([
            "post_title" => "required",
            "postimg" => "required"
            ]);
            // print_r($request->postimg);
            // print_r($request->hasfile('postimg'));
            if($request->hasfile('postimg')){
                $file = $request->file('postimg');
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path().'/products_images/', $name); 
                $NewsFeed = new news_feed();
                $NewsFeed->post_title = $request->post_title;
                $NewsFeed->image = $name;
                $NewsFeed->upload_by = Auth::user()->id;
                $NewsFeed->save();
                if($NewsFeed->save()){
                    return redirect()->back()->with('success','Post has been uploaded successfully');
                }else{
                    return redirect()->back()->with('error','Failed to upload post');
                }
            }else{
                    return redirect()->back()->with('error','Image file not found');
                }
    }

    public function userimage(Request $request){
        $user = DB::table('users')->where('id','=',$request->user_id)->first();
        $tablename = null;
        if($user->user_type == 2){ $tablename = 'student_profiles'; }
        if($user->user_type == 3){ $tablename = 'staff_profiles'; }
        if($user->user_type == 4){ $tablename = 'sponsor_profiles'; }
        if($user->user_type == 5){ $tablename = 'alumni_profiles'; }
        
        if (DB::table($tablename)->where('user_id', '=', $request->user_id)->exists()) {
            $reponse = DB::table($tablename)->where('user_id', $request->user_id)->select('name', 'picture')->first();
            // return $img;
            return response()->json([$reponse]);
         }else{
            $response = array('name'=>'unknown', 'picture'=>'167542559358.jpg');
            return response()->json([$reponse]);
         }
    }
}
