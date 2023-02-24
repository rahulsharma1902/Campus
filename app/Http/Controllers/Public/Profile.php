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
        return redirect('/my-account/studentprofile');
      }if(Auth::user()->user_type == 3){
        return redirect('/my-account/staffprofile');
      }if(Auth::user()->user_type == 4){
        return redirect('/my-account/sponsorprofile');
      }if(Auth::user()->user_type == 5){
        return redirect('/my-account/alumniprofile');
      }if(Auth::user()->user_type == 1){
        return redirect('/admindash/dashboard');
      }else{
          return redirect('/');
      }
    }else{
      return abort(404);
    }
  }

  
}
