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
        // print_r(Auth::user()->id);
        // $request['page_id'] = 9;
        if($request){
        $data = DB::table('joinPages')
        ->where('user_id',Auth::user()->id)
        ->where('page_id',$request['page_id'])
        ->get();
        if(count($data) == 0){
            $joinPage = new joinPage();
            $joinPage->page_id = $request['page_id'];
            $joinPage->user_id = Auth::user()->id;
            $joinPage->status = 1;
            $joinPage->save();
            return response()->json('Page Join successfully');

        }else{
            DB::table('joinPages')
            ->where('user_id',Auth::user()->id)
            ->where('page_id',$request['page_id'])
            ->delete();
            return response()->json('You Unfollow this page');
        }
    }else{
        return response()->json('Failed To Join Page');
    }
    }

    }