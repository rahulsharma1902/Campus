<?php

namespace App\Http\Controllers\auth;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
// use Auth;
use Session;
use Illuminate\Validation\Rule;
use App\Rules\ReCaptcha;
use Illuminate\Support\Facades\Auth;
class coustamAuthController extends Controller
{
    //
    public function index(){

    }
    public function register(Request $request){
        $validated = $request->validate([
            'g-recaptcha-response' => 'required',
            'email' => 'required|unique:users,email|max:255',
            'username' => 'required|unique:users,username|max:255',
            'password' => 'required|min:6',
            'confirmpassword' => 'required_with:password|same:password',
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
                return redirect('/register')->with('success', 'you account has been active in 24 hours');
    }
    public function login(Request $request){
        $validated = $request->validate([
            'g-recaptcha-response' => 'required',
            'password' => 'required|min:6',
        ]);
        $user = $request->get('user');
        $password = $request->get('password');
        if (Auth::attempt(['email' => $user, 'password' => $password]) || Auth::attempt(['username' => $user, 'password' => $password])) {
            // $request->session()->flush();
            if(Auth::User()->status == 1){
                // $request->session()->flush();
                $user = Auth::User();
                $user_type =  Auth::user()->user_type; 
                // print_r($user_type);
                if($user_type == 1){
                    return redirect('/admindash/dashboard')->with('success','Welcome in Admin Panel');
                }else{
                    // print_r(Auth::user());
                    return redirect('/my-account')->with('success', 'Welcome '.$user->real_name.' '.$user->nick_name);
                }
            }elseif(Auth::User()->status == 2){
                Auth::logout();
                Session::flush();
                // echo 'By to many attemp Your account has been disabled';
                return redirect()->back()->with('warning', 'By to many attemp Your account has been disabled.Send Mail For Enable Your Account');
            }else{
                Auth::logout();
                Session::flush();
                return redirect('/login')->with('success', 'Your Account Activate In 24Hours');;
            }
    }else{
        if (User::where('email', '=', $request->user)->exists() || User::where('username', '=', $request->user)->exists()) {
            $attempts = session()->get('login.attempts', 0); 
            session()->put('login.attempts', $attempts + 1);
            // print_r($request->ip());
            // print_r(session()->all());
            // echo $request->session()->get('login.attempts');
            // $request->user = [
            //     "user"           => $request->user,
            //     "attempts"       => 0,
            // ];
            // session()->put($request->user, $request->user.'.attempts' + 1);
            // echo $request->session()->get($request->user);
            $attempts = session()->get($request->user, 0); 
            session()->put($request->user, $attempts + 1);
            // echo $request->session()->get($request->user);
                if($request->session()->get($request->user) == 3){
                    // echo 'To Many Attempt';
                    if(User::where('email', '=', $request->user)->exists()){
                      $user = User::where('email', '=', $request->user)->update(['status' => 2]);
                      return redirect()->back()->with('error', 'To many attempt '.$request->user.' has been blocked.');
                    //   print_r($user->id);
                    }else{
                        $user = User::where('username', '=', $request->user)->update(['status' => 2]);
                        return redirect()->back()->with('error', 'To many attempt ('.$request->user.') has been blocked.');
                        // print_r($user->id);
                    }
                }elseif($request->session()->get($request->user) >=  4){
                    // echo 'To Many Attempt, Your '.$request->user.'has been blocked.';
                    return redirect()->back()->with('error', 'To many attempt ('.$request->user.') has been blocked.');
                }else{
                    return redirect()->back()->with('error', 'Incorrect password');
                }
                // echo '<pre>';
        //  print_r(session()->all());
        //  echo '</pre>';
        //  Session::flush();
         
        }else{
        return redirect('/login')->with('error', 'Incorrect email or username');
        }
    }
    }
    // public function login(Request $request){
    //     $validated = $request->validate([
    //         'g-recaptcha-response' => 'required',
    //         'password' => 'required|min:6',
    //     ]);
    //     $user = $request->get('user');
    //     $password = $request->get('password');
    //     if (Auth::attempt(['email' => $user, 'password' => $password]) || Auth::attempt(['username' => $user, 'password' => $password])) {
    //         if(Auth::User()->status == 1){
    //             $user = Auth::User();
    //             $user_type =  Auth::user()->user_type; 
    //             print_r($user_type);
    //             if($user_type == 1){
    //                 return redirect('/admindash/dashboard')->with('success','Welcome in Admin Panel');
    //             }else{
    //                 return redirect('/my-account')->with('success', 'Welcome '.$user->real_name.' '.$user->nick_name);
    //             }
    //         }else{
    //             Auth::logout();
    //             Session::flush();
    //             return redirect('/login')->with('success', 'Your Account Activate In 24Hours');;
    //         }
    // }else{
    //     return redirect('/login')->with('error', 'Incorrect email or password');
    // }
    // }
    public function logout(){
        Auth::logout();
        Session::flush();
        // $request->session()->flush();
        return redirect('/login')->with('success', 'You have been logged out!');;
    }
}
