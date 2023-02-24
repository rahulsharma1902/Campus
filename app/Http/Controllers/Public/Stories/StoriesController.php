<?php

namespace App\Http\Controllers\Public\Stories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{college_name,
                course,
                student_profile,
                User,
                add_friend,
                notification,
                college_page,
                joinPage,
               
};
use App\Models\storie;

// use Auth;
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class StoriesController extends Controller
{
   
    public function index(Request $request){
        if($request->hasfile('file')){
            $request->validate([
                'file' => 'mimes:mp4,mov'
            ]);
        $file = $request->file('file');
        $name = time().rand(1,100).'.'.$file->extension();
        $file->move(public_path().'/video/', $name); 
        $story = new storie();
        $story->user_id = $request->id;
        $story->video_url = $name;
        $story->save();
        return response()->json('saved video successfully');
        }
    }

}
