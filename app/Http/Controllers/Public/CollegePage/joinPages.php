<?php

namespace App\Http\Controllers\Public\CollegePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{college_name,
                college_page,
                alumni_profile,
                User,
                joinPage,
                notification,
};
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class joinPages extends Controller
{
    //
    public function index(){
        echo('hi');
    }
    public function joinpage(Request $request){
        // print_r(Auth::user()->id);
        // $request['page_id'] = 9;
        if($request){
        $data = DB::table('joinPages')
        ->where('user_id',Auth::user()->id)
        ->where('page_id',$request['page_id'])
        ->get();
        if(count($data) == 0){
            $joinPage = new joinPage();
            $joinPage->page_id = $request['page_id'];
            $joinPage->user_id = Auth::user()->id;
            $joinPage->status = 1;
            $joinPage->save();
            if($joinPage){
                $data = joinPage::with(['collegepage'])->where('page_id', '=', $request['page_id'])->first();
                $PostNotification = new notification();
                $PostNotification->user_id = Auth::user()->id;
                $userid = DB::table('staff_profiles')->where('id', '=', $data->collegepage->moderator_id)->first();
                $PostNotification->notification_to = $userid->user_id;
                $PostNotification->data = 'Join Your College Page';
                $PostNotification->save();
            }
            return response()->json('Page Join successfully');

        }else{
            DB::table('joinPages')
            ->where('user_id',Auth::user()->id)
            ->where('page_id',$request['page_id'])
            ->delete();
                $data = joinPage::with(['collegepage'])->where('page_id', '=', $request['page_id'])->first();
                $PostNotification = new notification();
                $PostNotification->user_id = Auth::user()->id;
                $userid = DB::table('staff_profiles')->where('id', '=', $data->collegepage->moderator_id)->first();
                $PostNotification->notification_to = $userid->user_id;
                $PostNotification->data = 'Unfollow Your College Page';
                $PostNotification->save();
            return response()->json('You Unfollow this page');
        }
    }else{
        return response()->json('Failed To Join Page');
    }
    }
    public function join(Request $request){
        if(Auth::user()){
        if(DB::table('joinPages')->where('page_id',$request->page_id)->where('user_id',Auth::user()->id)->exists()){
            DB::table('joinPages')->where('page_id',$request->page_id)->where('user_id',Auth::user()->id)->delete();
            return response()->json([true,'UNFOLLOW']);
        }else{
            $joinPage = new joinPage();
            $joinPage->page_id = $request->page_id;
            $joinPage->user_id = Auth::user()->id;
            $joinPage->status = 1;
            $joinPage->save();
            return response()->json([true,'FOLLOW']);
        }
    }else{
        return response()->json([false]);
    }
}
    }