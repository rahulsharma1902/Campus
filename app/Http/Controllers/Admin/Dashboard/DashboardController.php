<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
// use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    //
    public function index(){
        return view('Admin.index');
    }
    public function Users(){
        $users = User::where('user_type','!=','1')->get();
        return view('Admin.Dashboard.Users')->with('user',$users);
    }
    public function update(Request $request){

        $user = User::findOrFail($request->id);
        $user->user_type = $request->usertype;
        $user->save();
        if($user->save()){
            return response()->json('success');
        }


    }
    public function userrequests(){
        $requests = User::where('status',0)->get();
        return view('Admin.Dashboard.UsersRequest.index')->with('requests',$requests);
    }
    
}
