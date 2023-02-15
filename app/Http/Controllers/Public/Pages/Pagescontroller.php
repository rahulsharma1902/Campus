<?php
namespace App\Http\Controllers\Public\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File;
use App\Models\college_page;
use App\Models\User;
use App\Models\student_profile;

class Pagescontroller extends Controller
{
    public function index(){
        $data = Auth()->user();
        $profile = DB::table('staff_profiles')->where('user_id', $data->id)->first();
        if($profile){
        $college_page = DB::table('college_pages')->where('moderator_id', $profile->id)->first();
        if($college_page){
            return view('Public.Staff.AddPages')->with('pagedata',$college_page);

        }else{
            return redirect('/Staff/profile')->with('error','You have no college pages');

        }
        }else{
            return redirect('/Staff/profile')->with('error','You have no college pages');
        }
    }
    public function AddPagedata(Request $request){
    // print_r($request->documents);
    $data = DB::table('student_profiles')->where('college_id', $request->college_id)->get();   
     $population = count($data);
    //  print_r($population);
    if($request->hasfile('images')){
        if ($request->documents){
            $data= array();
            foreach($request->documents as $file) {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path().'/products_images/', $name);
            array_push($data,$name);
            }
            $gallery = implode(",",$data);
            print_r($gallery);
        }
        
        
        $request->validate([
            'images' => 'required|dimensions:min_height=400,max_height=600',
            'college_name' => 'required',
            'history' => 'required',
            'address' => 'required',
            'type' => 'required',
            'admin_contact' => 'required',
            'location' => 'required',
            'union_leader' => 'required',
            'information_section' => 'required',
        ]);
        $file = $request->file('images');
        $name = time().rand(1,100).'.'.$file->extension();
        $file->move(public_path().'/products_images/', $name); 
        if($request->id !== null){
            $college_page = college_page::find($request->id);
            $college_page->college_name = $request->college_name;
            $college_page->history = $request->history;
            $college_page->address = $request->address;
            $college_page->type = $request->type;
            $college_page->admin_contact = $request->admin_contact;
            $college_page->location = $request->location;
            $college_page->population = $population;
            $college_page->union_leader = $request->union_leader;
            $college_page->images = $name;
            $college_page->Gallery = $gallery;
            $college_page->information_section = $request->information_section;
            $college_page->status = 1;
            $college_page->update();
            return redirect('/home/pages')->with('success','data uploaded successfully');
        }
    }else{
        return redirect()->back()->with('error','Invalid request');
    }
    }

}