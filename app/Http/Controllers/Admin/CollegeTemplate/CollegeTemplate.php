<?php

namespace App\Http\Controllers\Admin\CollegeTemplate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ User,
        college_name,
        college_page,
        staff_profile,
        template,
};
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class CollegeTemplate extends Controller
{
    //
    public function getModerator(Request $request){
        $college_id = $request->college_id;
        $staff = staff_profile::where('college_id', $college_id)->get();
        // print_r($staff);
        return response()->json($staff);

    }
    public function create(Request $request){
        $college_id = $request["college_id"];
        $moderator_id = $request["moderator_id"];
        if (college_page::where('college_id', $college_id)->exists()) {
            return response()->json(['msg' => 'Page Already Exists']); 
        }else{
        $college_page = new college_page();
        $college_page->college_id = $college_id;
        $college_page->moderator_id = $moderator_id;
        $college_page->status = 0;
        $college_page->save();
        return response()->json(['success' => 'College template Genrate Succefully']); 
    } 
    }
   
    public function createTemplate(Request $request){
        print_r($request->all());
    }

    public function addTemplate(){
        $data = college_name::with(['moderators','collegepage','collegepage.moderator'])->withCount('collegepage')
        ->get()
        ->toArray();
        // echo '<pre>';
        // print_r($data);
        // // for($i=0;$i<count($data);$i++){
        // //     print_r($data[$i]['collegepage']['moderator']['name'] ?? '');
        // //     // for($x=0;$x<count($data[$x]['moderators']);$x++){
        // //     //     print_r($data[$i]['moderators'][$x] ?? '');
        // //     // }
        // // }
        // echo '</pre>';

        // die();
        return view('Admin.Colleges.AddTemplate.index',compact('data'));
    }
    public function templatecreat(Request $request){
        $college_id = $request["college_id"];
        $moderator_id = $request["moderator_id"];
        $template_id = $request["template_id"];
            if (college_page::where('college_id', $college_id)->exists()) {
                return response()->json(false); 
            }else{
                $college_page = new college_page();
                $college_page->college_id = $college_id;
                $college_page->moderator_id = $moderator_id;
                $college_page->template_id = $template_id;
                $college_page->status = 0;
                $college_page->save();
                return response()->json(true); 
            }
    }
    public function templategen($id){
      $page_id = DB::table('college_pages')->where('college_id','=', $id)->first();
      $college_page = college_page::with(['college','staff'])->where('id', $page_id->id)->first()->toArray();

      if($college_page['template_id'] == 1){

            return view('Admin.Templates.Template1.index',compact('college_page'));

        } elseif($college_page['template_id'] == 2){

                return view('Admin.Templates.Template2.index',compact('college_page'));
            }else{
                return redirect()->back()->with('error','Template not found');
            }
    }
    public function trycode(){
        $page_id = 6;
        $college_page = college_page::with(['college','staff'])->where('id', $page_id)->first()->toArray();
        echo '<pre>';
        // print_r($college_page);
        echo '</pre>';
        // print_r($college_page['template_id']);
        if($college_page['template_id'] == 1){
            return $this->template1($college_page);
        }
    }
public function template1($college_page){
    // echo '<pre>';
    // print_r($college_page);
    // echo '</pre>';
    return view('Admin.Templates.Template1.index',compact('college_page'));
}
public function addtemplatedata(Request $request){
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
}