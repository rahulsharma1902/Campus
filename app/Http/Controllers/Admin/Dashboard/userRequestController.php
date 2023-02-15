<?php

namespace App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;
use App\Models\User;

class userRequestController extends Controller
{
    public function index(){
        $requests = User::where('status',0)->get();
        return view('Admin.Dashboard.UserRequest')->with('requests',$requests);
    }
    public function userrequestsresponse(Request $request){
        if($request->res ==1){
            $user = User::find($request->id);
            $user->status = $request->res;
            $user->save();
           
            return response()->json('successfully accepted');
            
        }else{
            User::where('id',$request->id)->delete();
            return response()->json('successfully rejected');
        } 
       }
    }

