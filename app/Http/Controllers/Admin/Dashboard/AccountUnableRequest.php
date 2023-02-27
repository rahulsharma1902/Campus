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
class AccountUnableController extends Controller
{
    //
    public function index(){
        return view('admin.dashboard.account-unable-request');

    }

}
