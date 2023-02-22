<?php

namespace App\Http\Controllers\Public\CollegePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
                    college_name,
                    college_page,
                    alumni_profile,
                    staff_profile,
                    User,
                    post,
                    notification,
                };
// use App\Models\joinPage;
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
        if(Auth::user()){
        $SinglePage = college_page::where('id',$id)->first();
       if(Auth::user()->user_type == 3){  
          $staffData =   DB::table('staff_profiles')->where('user_id',Auth::user()->id)->first();
        //   print_r($staffData->college_id);
        //   print_r($SinglePage->college_id);
        //   if($SinglePage->college_id == $staffData->college_id){
        //     echo 'You can Post on this page';
        //   }else{
        //     echo 'You can not post on this page';
        //    }
       }else{
        $staffData = null;
       }
       $allPosts = DB::table('posts')->where('college_page_id',$SinglePage->id)->orderBy('created_at', 'desc')->get();

        $totalPopulation = DB::table('college_pages')
            ->join('student_profiles', 'college_pages.college_id', '=', 'student_profiles.college_id')
            ->select('college_pages.*', 'student_profiles.id')
            ->get();
        $followers = DB::table('joinPages')
            ->where('page_id',$id)
            ->get();
        $joinBtn = DB::table('joinPages')
            ->where('user_id',Auth::user()->id)
            ->where('page_id',$id)
            ->get();
            // print_r(count($totalPopulation));

        return view('Public.Home.CollegePages.SinglePage',compact('SinglePage','totalPopulation','joinBtn','followers','staffData','allPosts'));
    }else{
        return redirect()->back()->with('error', 'You Need To Login First');
    }
}
    public function addPost(Request $request){
        $request->validate([
            "description" => "required",
            "postimg" => "required"
            ]);
        if($request->hasfile('postimg')){
        $file = $request->file('postimg');
        $name = time().rand(1,100).'.'.$file->extension();
        $file->move(public_path().'/products_images/', $name); 
        $post = new post();
        $post->description = $request->description;
        $post->image = $name;
        $post->college_page_id = $request->college_page_id;
        $post->staff_profile_id = $request->staff_profile_id;
        $post->save();
        if($post->save()){
            return redirect()->back()->with('success','successfully post image');
        }else{
            return redirect()->back()->with('error','something went wrong');
        }
        }
        else{
            return redirect()->back()->with('error','somthing went wrong');
        }
    }


    public function deletePost(Request $request){
        if($request){
            $post = post::find($request->post_id)->delete();
            return response()->json('Post deleted successfully.');
        }
    }
    }

