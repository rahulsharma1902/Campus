<?php

namespace App\Http\Controllers\Public;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{college_name,
                college_page,
                alumni_profile,
                staff_profile,
                student_profile,
                sponsor_profile,
                joinPage,
                User,
                post,
                storie,
                add_friend,
            };
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class MainController extends Controller
{
    //
    public function index(){
        return view('Public.Home.fronthome');
    }
    public function register(){
        return view('Public.auth.Register.index');
    }
    public function login(){
        return view('Public.auth.Login.index');
    }
    public function home(){
        if(Auth::user()){
        $postData = DB::table('joinPages')
        ->select('staff_profiles.*', 'posts.*')
        ->join('posts', 'joinPages.page_id', '=', 'posts.college_page_id')
        ->join('staff_profiles', 'posts.staff_profile_id', '=', 'staff_profiles.id')
        ->where('joinPages.user_id', '=' , Auth::user()->id)->orderBy('posts.created_at', 'desc')->get();
        // echo '<pre>';
        // print_r($postData);
        // echo'</pre>';
        $userdata = User::with(['student','staff','sponsor','alumni','friends.stories','friends.users','friends.student','friends.staff','friends.sponsor','friends.alumni'])
        ->where('id', '=', Auth::user()->id)   
        ->get()
        ->toArray();   
        // echo '<pre>';
        // print_r($userdata);
        // dd(array_filter($userdata));
        // $us = array_filter($userdata);
        // if (array_key_exists("student",$us)){
        //     echo "student exists!";
        //     // print_r($userdata->student['name']);
        //     }elseif(array_key_exists("staff",$us)){
        //     }else{
        //         echo 'working failed';
        //     }
        // print_r($userdata[0]['student']);
        // echo '</pre>';
        // die();
        return view('Public.Home.index',compact('postData','userdata'));
    }else{
        $postData = null;
        return view('Public.Home.index',compact('postData'));
    }
}

     public function disabledaccount(){
        return view('Public.auth.Disabled.index');
     }

     public function uniqueusername(Request $request){
        if(User::where('username','=',$request->username)->exists()){  
            return response()->json([false]);
        }else{
            return response()->json([true]);
        }
        
     }
}
