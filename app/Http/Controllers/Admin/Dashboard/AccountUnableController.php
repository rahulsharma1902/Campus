<?php

namespace App\Http\Controllers\Admin\Dashboard;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User,
                requnableaccount,
                };
// use Auth;
use Session;
use Illuminate\Validation\Rule;
use App\Rules\ReCaptcha;
use Illuminate\Support\Facades\Auth;
use DB;
class AccountUnableController extends Controller
{
    //
    public function index(){
        
        $accounts = requnableaccount::with(['users'])->where('status', '=', 1)->get()->toArray();
        // dd($accounts);
        // foreach($accounts as $account){
        //     print_r($account['users']['email']);
        //     print_r($account['reason']);
        // }
        // die();
        return view('Admin.Dashboard.AccountUnableRequest',compact('accounts'));

    }
    public function activeAccount(Request $request){
        if($request){
            DB::table('users')->where('id', '=', $request->user_id)->update(['status' => 1]);
            DB::table('requnableaccounts')->where('user_id', '=', $request->user_id)->update(['status' => 0]);
            return response()->json([true]);
        }else{
            return response()->json([false]);
        }
        
    }

}
