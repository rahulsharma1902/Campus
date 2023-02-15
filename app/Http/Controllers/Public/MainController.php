<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\college_name;
use App\Models\college_page;
use App\Models\alumni_profile;
use App\Models\staff_profile;
use App\Models\joinPage;
use App\Models\User;
use App\Models\post;
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class MainController extends Controller
{
    //
    public function index(){
        return view('Public.index');
    }
    public function register(){
        return view('Public.auth.Register.index');
    }
    public function login(){
        return view('Public.auth.Login.index');
    }
    // public function home(){
    //     $JoinId = joinPage::where('user_id',Auth::user()->id)->get();
    //     // print_r($JoinId);
    //     foreach($JoinId as $key => $value){
    //         print_r($value->page_id);
    //         $posts = post::where('college_page_id', $value->page_id)->get();
    //         // echo '<pre>';
    //         // print_r($posts);
    //         // echo '</pre>';
    //         foreach($posts as $d){            
    //             echo($d->description);
    //            echo($d->image);
    //            echo '<br>';
                
    //         }
    //     }
    // }

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
        return view('Public.Home.index',compact('postData'));
    }else{
        $postData = null;
        return view('Public.Home.index',compact('postData'));
    }
}
}



// $postData = DB::table('college_pages')
// ->select('staff_profiles.*', 'posts.*')
// ->join('joinPages', 'college_pages.id', '=', 'joinPages.page_id')
// ->join('posts', 'joinPages.page_id', '=', 'posts.college_page_id')
// ->join('staff_profiles', 'joinPages.staff_profile_id', '=', 'staff_profiles.id')
// ->where('user_id',Auth::user()->id)->get();
// // echo '<pre>';
// // print_r($postData);
// // echo'</pre>';
// return view('Public.Home.index',compact('postData'));






// foreach($cat as $c){
//     $product_id = null;
//     $product_productname = null;
//     $cat_id = $c->id;
//     $data = \DB::table('products')->where('category',$cat_id)
//     ->orWhere('category','like', $cat_id.'%')
//     ->orWhere('category','like','%'.$cat_id.'%')
//     ->orwhere('category','like','%'.$cat_id)->get();
//     foreach($data as $d){            
//         $product_id[] =  $d->id;
//         $product_productname[] =  $d->productname;
        
//     }
// $catWithId[] = array($c->category => array_combine($product_id ?? array(),$product_productname ?? array()));        
// }