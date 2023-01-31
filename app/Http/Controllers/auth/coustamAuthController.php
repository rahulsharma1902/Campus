<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
// use Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class coustamAuthController extends Controller
{
    //
    public function index(){

    }
    public function register(Request $request){
        $validated = $request->validate([
            'email' => 'required|unique:users,email|max:255',
            'username' => 'required|unique:users,username|max:255',
            'password' => 'required|min:6',
            'phone_number' => 'required||unique:users,phone_number|numeric|min:10'
        ]);
        $password = bcrypt($request['password']);

                $user = new User();
                $user->real_name = $request['real_name'];
                $user->nick_name = $request['nick_name'];
                $user->email = $request['email'];
                $user->phone_number = $request['phone_number'];
                $user->username = $request['username'];
                $user->password = $password;
                $user->user_type = $request['user_type'];
                $user->status = 0;
                $user->save();
                return view('Public.auth.Register.index')->with('success', 'you account has been active in 24 hours');
    }

    public function login(Request $request){
        $user = $request->get('user');
        $password = $request->get('password');
        if (Auth::attempt(['email' => $user, 'password' => $password]) || Auth::attempt(['username' => $user, 'password' => $password])) {

                $user = Auth::User();
                $user_type =  Auth::user()->user_type; 
                print_r($user_type);
                if($user_type == 1){
                    return redirect('/admindash/dashboard')->with('success','Welcome in Admin Panel');
                }else{
                    return redirect('/')->with('success', 'Welcome '.$user->real_name.' '.$user->nick_name);
                }
    }else{
        return redirect('/login')->with('error', 'Incorrect email or password');
    }
    }
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/login')->with('success', 'You have been logged out!');;
    }
}
