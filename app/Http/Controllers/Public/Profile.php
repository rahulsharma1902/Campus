<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\college_name;
use App\Models\course;
use App\Models\User;
// use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class Profile extends Controller
{
    //
    public function index(){
      if(Auth::user()){
      if(Auth::user()->user_type == 2){
        return redirect('/student/'.Auth::user()->username)->with('success', 'Welcome In Student Dashboard '.Auth::user()->username);
      }if(Auth::user()->user_type == 3){
        return redirect('/staff/'.Auth::user()->username)->with('success', 'Welcome In Staff Dashboard '.Auth::user()->username);
      }if(Auth::user()->user_type == 4){
        return redirect('/sponsor/'.Auth::user()->username)->with('success', 'Welcome In Sponsor Dashboard '.Auth::user()->username);
      }if(Auth::user()->user_type == 5){
        return redirect('/alumni/'.Auth::user()->username)->with('success', 'Welcome In Alumni Dashboard '.Auth::user()->username);
      }if(Auth::user()->user_type == 1){
        return redirect('/admindash/dashboard')->with('success', 'Welcome In Admin Dashboard '.Auth::user()->username);
      }else{
          return redirect('/');
      }
    }else{
      return abort(404);
    }
  }

  
}
