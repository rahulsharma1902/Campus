<?php

namespace App\Http\Controllers\Public\Notification;

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

use Carbon\Carbon;


// use Auth;
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
   
    public function index(){
        if (DB::table('post_notifications')->where('notification_to', '=', Auth::user()->id)->exists()){
        $data = DB::table('post_notifications')->where('notification_to', '=', Auth::user()->id)->orderby('created_at', 'desc')->get()->toArray();
        foreach($data as $d){
            // echo $d->user_id;
            $user = DB::table('users')->where('id', $d->user_id)->first();
            $notificationdata[] = array_merge(array($d),array($user->real_name));
            // print_r($d);
        }
        // // print_r($notificationdata);
        // foreach($notificationdata as $not){
        //     print_r($not[0]->id);
        //     print_r($not[1]);
        // }
        // die();
        return view('Public.Home.Notification.index',compact('notificationdata'));
    }else{
        $notificationdata = array();
        return view('Public.Home.Notification.index',compact('notificationdata'));
    }
    }

    public function markasread(Request $request){
        $notification = DB::table('post_notifications')->where('id', $request->notification_id)->update(['read_at' => Carbon::now()->toDateTimeString()]);   
        return response()->json(['mark as read']);

    }


    public function allnotifications(Request $request){
        if (DB::table('notifications')->where('notification_to', '=', Auth::user()->id)->exists()){
            $data = DB::table('notifications')
            ->where('notification_to', '=', Auth::user()->id)
            ->where('read_at', '=', 0)
            ->orderby('created_at', 'desc')->get()->toArray();
            foreach($data as $d){
                $user = DB::table('users')->where('id', $d->user_id)->first();
                $notificationdata[] = array_merge(array($d),array($user->real_name));
            }
            return response()->json([$notificationdata,true]);
        }else{
            return response()->json([false]);
        }
    }
}
