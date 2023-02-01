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
      if(Auth::user()->user_type == 2){
        return redirect('/studentprofile');
      }if(Auth::user()->user_type == 3){
        return redirect('/staffprofile');
      }if(Auth::user()->user_type == 4){
        return redirect('/sponserprofile');
      }if(Auth::user()->user_type == 5){
        return redirect('/alumniprofile');
      }if(Auth::user()->user_type == 1){
        return redirect('/admindash/dashboard');
      }else{
          return redirect('/');
      }
    }

  
}
