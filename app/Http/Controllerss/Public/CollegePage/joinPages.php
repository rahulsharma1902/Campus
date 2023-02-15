<?php

namespace App\Http\Controllers\Public\CollegePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\college_name;
use App\Models\college_page;
use App\Models\alumni_profile;
use App\Models\User;
use App\Models\joinPage;
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class joinPages extends Controller
{
    //
    public function index(){
        echo('hi');
    }
    public function joinpage(Request $request){
        
        $joinPage = new joinPage();
        $joinPage = $request['page_id'];
        $joinPage = Auth::user()->id;
        $joinPage->save();
        return response()->json('Done successfully', 200);
    }
    }