<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function index(){
        return view('Public.index');
    }
    public function register(){
        return view('Public.auth.Register.index');
    }
}
