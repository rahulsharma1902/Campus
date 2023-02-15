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
class collegepage extends Controller
{
    //
    public function index(){
        $college_page = college_page::all();
        return view('Public.Home.CollegePages.index',compact('college_page'));
    }

    public function SinglePage(Request $request,$id){
        $SinglePage = college_page::where('id',$id)->first();
        $totalPopulation = DB::table('college_pages')
            ->join('student_profiles', 'college_pages.college_id', '=', 'student_profiles.college_id')
            ->select('college_pages.*', 'student_profiles.id')
            ->get();
            // print_r(count($totalPopulation));
            $join = joinPage::all();
            print_r($join);
        return view('Public.Home.CollegePages.SinglePage',compact('SinglePage','totalPopulation'));
    }
      public function joinpage(Request $request){
        
        $joinPage = new joinPage();
        $joinPage = $request['page_id'];
        $joinPage = Auth::user()->id;
        $joinPage->save();
        return response()->json('Done successfully', 200);
    }
    }

