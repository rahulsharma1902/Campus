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
use App\Models\like_post;
use App\Models\comment_post;
use App\Models\post_notification;
use App\Models\notification;

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
        foreach($followuser as $key=>$value){
            $followPOST[] = DB::table('news_feeds')->where('upload_by',$value->friend_id)->get()->toArray();
        }

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

    public function likepost(Request $request){
        if($request->post_id){
            if (DB::table('like_posts')->where('like_by', '=', Auth::user()->id)->where('post_id', '=', $request->post_id)->exists()) {
                DB::table('like_posts')->where('like_by', '=', Auth::user()->id)->where('post_id', '=', $request->post_id)->delete();
                return response()->json([false]);
             }else{
                $like_post = new like_post();
                $like_post->like_by = Auth::user()->id;
                $like_post->post_id = $request->post_id;
                $like_post->status = 1;
                $like_post->save(); 
                if($like_post){
                    $data = DB::table('news_feeds')->where('id', $request->post_id)->first();
                    $PostNotification = new notification();
                    $PostNotification->user_id = Auth::user()->id;
                    $PostNotification->notification_to = $data->upload_by;
                    $PostNotification->data = 'Like On Your Post';
                    $PostNotification->save();
                }
                return response()->json([true]);
             }
        }else{
            return response()->json(['Enable To Find Post']);
        }
    }
    public function checklikes(Request $request){
        if($request->post_id){
            if (DB::table('like_posts')->where('like_by', '=', Auth::user()->id)->where('post_id', '=', $request->post_id)->exists()) {
                $likes = news_feed::find($request->post_id)->likes->count();
                return response()->json([$likes,true]);
             }else{
                $likes = news_feed::find($request->post_id)->likes->count();
                return response()->json([$likes,false]);
             }
        }
    }
    public function countcomments(Request $request){
        if($request->post_id){
            if (DB::table('comment_posts')->where('post_id', '=', $request->post_id)->exists()) {
                $comment = news_feed::find($request->post_id)->comment->count();
                return response()->json([$comment,true]);
             }else{
                $comment = 0;
                return response()->json([$comment,false]);
             }
        }  
    }
    public function commentpost(Request $request){
        if($request->comment){
            $comment = new comment_post();
            $comment->comment = $request->comment;
            $comment->comment_by = Auth::user()->id;
            $comment->post_id = $request->post_id;
            $comment->save();
            if($comment){
                $data = DB::table('news_feeds')->where('id', $request->post_id)->first();
                $PostNotification = new notification();
                // $PostNotification->post_id = $request->post_id;
                $PostNotification->user_id = Auth::user()->id;
                $PostNotification->notification_to = $data->upload_by;
                $PostNotification->data = 'Comment On Your Post';
                $PostNotification->save();
            }
        return response()->json([true]);
    }else{
        return response()->json([false
    ]);
    }

}

//     public function commentpost(Request $request){
//         if($request->comment){
//             $comment = new comment_post();
//             $comment->comment = $request->comment;
//             $comment->comment_by = Auth::user()->id;
//             $comment->post_id = $request->post_id;
//             $comment->save();
//             if($comment){
//                 $data = DB::table('news_feeds')->where('id', $request->post_id)->first();
//                 $PostNotification = new post_notification();
//                 $PostNotification->post_id = $request->post_id;
//                 $PostNotification->user_id = Auth::user()->id;
//                 $PostNotification->notification_to = $data->upload_by;
//                 $PostNotification->Type = 'Comment';
//                 $PostNotification->save();
//             }
//         return response()->json([true]);
//     }else{
//         return response()->json([false
//     ]);
//     }

// }
public function comments(Request $request){
    if($request->post_id){
        if (DB::table('comment_posts')->where('post_id', '=', $request->post_id)->exists()) {
            $comments = DB::table('comment_posts')->where('post_id', '=', $request->post_id)->get();
            foreach($comments as $comment){
                // $comment_id[] =  $comment->comment_by;
                $user = DB::table('users')->where('id','=',$comment->comment_by)->first();
                $tablename = null;
                if($user->user_type == 2){ $tablename = 'student_profile'; }
                if($user->user_type == 3){ $tablename = 'staff_profile'; }
                if($user->user_type == 4){ $tablename = 'sponsor_profile'; }
                if($user->user_type == 5){ $tablename = 'alumni_profile'; }

                $profile = User::find($user->id)->$tablename;
                $commentsdata[] = array_merge(array($profile),array("comment"=>$comment->comment, "comment_id"=>$comment->id));
            }
            return response()->json([$commentsdata ,true]);
         }else{
            
            return response()->json([false]);
         }
    }
        return response()->json(['Comments']);
}
}
