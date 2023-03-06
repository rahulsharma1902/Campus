<?php
namespace App\Http\Controllers\Public\CollegeModerator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File;
use App\Models\college_page;
use App\Models\User;
use Auth;
use App\Models\student_profile;
use App\Models\template;


class CollegeModerator extends Controller
{
    public function index(){
        $profile = DB::table('staff_profiles')->where('user_id', Auth::user()->id)->first();
        if(college_page::where('moderator_id', '=', $profile->id)->exists()){
            $college_page = college_page::where('moderator_id',$profile->id)->first();
            return view('Public.Staff.collegemoderator', compact('college_page'));
        }else{
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
    }
    // public function update(Request $request){
    //     // echo '<pre>';
    //     // print_r($request->all());
    //     // echo '</pre>';
    //     $data = DB::table('student_profiles')->where('college_id', $request->college_id)->get();   
    //  $population = count($data);
    // //  print_r($population);
    // if($request->hasfile('images')){
    //     if ($request->documents){
    //         $data= array();
    //         foreach($request->documents as $file) {
    //             $name = time().rand(1,100).'.'.$file->extension();
    //             $file->move(public_path().'/products_images/', $name);
    //         array_push($data,$name);
    //         }
    //         $gallery = implode(",",$data);
    //         print_r($gallery);
    //     }
    //     $request->validate([
    //         'images' => 'required',
    //         // 'images' => 'required|dimensions:min_height=400,max_height=600',
    //         'college_name' => 'required',
    //         'history' => 'required',
    //         'address' => 'required',
    //         'type' => 'required',
    //         'admin_contact' => 'required',
    //         'location' => 'required',
    //         'union_leader' => 'required',
    //         'information_section' => 'required',
    //     ]);
    //     $file = $request->file('images');
    //     $name = time().rand(1,100).'.'.$file->extension();
    //     $file->move(public_path().'/products_images/', $name); 
    //     if($request->id !== null){
    //         $college_page = college_page::find($request->id);
    //         $college_page->college_name = $request->college_name;
    //         $college_page->history = $request->history;
    //         $college_page->address = $request->address;
    //         $college_page->type = $request->type;
    //         $college_page->admin_contact = $request->admin_contact;
    //         $college_page->location = $request->location;
    //         $college_page->population = $population;
    //         $college_page->union_leader = $request->union_leader;
    //         $college_page->images = $name;
    //         $college_page->Gallery = $gallery;
    //         $college_page->information_section = $request->information_section;
    //         $college_page->status = 1;
    //         $college_page->update();

    //         $college_page->update();
           
    //         // return redirect('/home/pages')->with('success','data uploaded successfully');
    //     }
    // }else{
    //     $college_page = college_page::find($request->id);
    //         $college_page->college_name = $request->college_name;
    //         $college_page->history = $request->history;
    //         $college_page->address = $request->address;
    //         $college_page->type = $request->type;
    //         $college_page->admin_contact = $request->admin_contact;
    //         $college_page->location = $request->location;
    //         $college_page->population = $population;
    //         $college_page->union_leader = $request->union_leader;
    //         // $college_page->images = $name;
    //         // $college_page->Gallery = $gallery;
    //         $college_page->information_section = $request->information_section;
    //         $college_page->status = 1;

    //         $college_page->update();
    // }
    // $college_page = college_page::with(['college','staff','staff.department'])->where('id', $request->id)->first()->toArray();

    // if($college_page['template_id'] == 1){

    //       return view('Admin.Templates.Template1.index',compact('college_page'));

    //   } elseif($college_page['template_id'] == 2){

    //           return view('Admin.Templates.Template2.index',compact('college_page'));
    //       }else{
    //           return redirect()->back()->with('error','Template not found');
    //       }
    // }

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

            $college_page = college_page::with(['college','staff','staff.department'])->where('id', $request->id)->first()->toArray();

            if($college_page['template_id'] == 1){
      
                  return view('Admin.Templates.Template1.index',compact('college_page'));
      
              } elseif($college_page['template_id'] == 2){
      
                      return view('Admin.Templates.Template2.index',compact('college_page'));
                  }else{
                      return redirect()->back()->with('error','Template not found');
                  }
            // return redirect('/home/pages')->with('success','data uploaded successfully');
        }
    }else{
        return redirect()->back()->with('error','Invalid request');
    }
    }
    public function tryajax(Request $request){
        if(template::where('college_page_id', $request->college_page)->exists()){
        template::where('college_page_id', $request->college_page)->update(['template' => $request->template]);
        return response()->json(['Update Done']);
        }else{
            $template = new template();
            $template->template = $request->template;
            $template->college_page_id = $request->college_page;
            $template->save();
            return response()->json(true);
        }
    }





    public function update(Request $request){
        $data = DB::table('student_profiles')->where('college_id', $request->college_id)->get();   
     $population = count($data);
    if($request->hasfile('images')){
        if ($request->documents){
            $data= array();
            foreach($request->documents as $file) {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path().'/products_images/', $name);
            array_push($data,$name);
            }
            $gallery = implode(",",$data);
            // print_r($gallery);
        }else{
            $d = DB::table('college_pages')->where('college_id', $request->college_id)->first();
            $gallery = $d->Gallery;
        }
        $request->validate([
            'images' => 'required',
            // 'images' => 'required|dimensions:min_height=400,max_height=600',
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
        
    }else{
        $dname = DB::table('college_pages')->where('college_id', $request->college_id)->first();
        $name = $dname->images;
        if ($request->documents){
            $data= array();
            foreach($request->documents as $file) {
                $na = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path().'/products_images/', $na);
            array_push($data,$na);
            }
            $gallery = implode(",",$data);
            // print_r($gallery);
        }else{
            $d = DB::table('college_pages')->where('college_id', $request->college_id)->first();
            $gallery = $d->Gallery;
        }
        
    }
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

    $college_page = college_page::with(['college','staff','staff.department'])->where('id', $request->id)->first()->toArray();

    if($college_page['template_id'] == 1){

          return view('Admin.Templates.Template1.index',compact('college_page'));

      } elseif($college_page['template_id'] == 2){

              return view('Admin.Templates.Template2.index',compact('college_page'));
          }else{
              return redirect()->back()->with('error','Template not found');
          }
    }

    public function trycode(){
        $college_page = college_page::with(['college','staff','staff.department'])->where('id', 29)->first()->toArray();
        echo '<pre>';
        print_r($college_page);
        print_r($college_page['staff'][0]['department']['position_name']);
        echo '</pre>';
    }
}