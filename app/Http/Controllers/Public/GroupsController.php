<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\college_names;
use App\Models\college_page;
use App\Models\alumni_profile;
use App\Models\staff_profile;
use App\Models\joinPage;
use App\Models\User;
use App\Models\post;
use App\Models\group;
use App\Models\message;

use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class GroupsController extends Controller
{
    //
    public function index(){
        $userId = null;
        $myCollegeId = null;
        if(Auth::user()){
if( Auth::user()->user_type == 2){
    $userId = Auth::user()->id;
    $CollegeId = DB::table('student_profiles')->where('user_id',$userId)->first();
    if($CollegeId){
            if($CollegeId->college_id){
                $myCollegeId = $CollegeId->college_id;
            }else{
                return redirect('/profile')->with('error', 'Pleace Complete Your Profile First.');
            }
    }else{
        return redirect('/profile')->with('error', 'Pleace Complete Your Profile First.');
    }
}elseif( Auth::user()->user_type == 3){
    $userId = Auth::user()->id;
    $CollegeId = DB::table('staff_profiles')->where('user_id',$userId)->first();
    if($CollegeId){
            if($CollegeId->college_id){
                $myCollegeId = $CollegeId->college_id;
            }else{
                return redirect('/profile')->with('error', 'Pleace Complete Your Profile First.');
            }
    }else{
        return redirect('/profile')->with('error', 'Pleace Complete Your Profile First.');
    }
}elseif( Auth::user()->user_type == 5){
    $userId = Auth::user()->id;
    $CollegeId = DB::table('alumni_profiles')->where('user_id',$userId)->first();
    if($CollegeId){
            if($CollegeId->college_graduated_from){
                $myCollegeId = $CollegeId->college_graduated_from;
            }else{
                return redirect('/profile')->with('error', 'Pleace Complete Your Profile First.');
            }
    }else{
        return redirect('/profile')->with('error', 'Pleace Complete Your Profile First.');
    }
}
else{
    $userId = "not you type";
}
}else{
    return redirect('/home')->with('error', 'User Not Found.');
}
        $SchoolMember = DB::table('student_profiles')->where('college_id',$myCollegeId)->get(['name','id','user_id']);
        $staffMember = DB::table('staff_profiles')->where('college_id',$myCollegeId)->get(['name','id','user_id']);
        $alumniMember = DB::table('alumni_profiles')->where('college_graduated_from',$myCollegeId)->get(['name','id','user_id']);
        $Obj1 = (array) $SchoolMember;
        $Obj2 = (array) $staffMember;
        $Obj3 = (array) $alumniMember;
        $addMember = (array) array_merge_recursive($Obj1, $Obj2 , $Obj3);


        $user_id = Auth()->user()->id;
    // print_r($userid);
        $groups = DB::table('groups')->where('group_members','like',$user_id.'%')->orWhere('group_members','like','%'.$user_id.'%')->orWhere('group_members','like','%'.$user_id)->get();     
        $groupWithMsg = null;
        foreach($groups as $c){
            // print_r($c->id);
            $sendernameImg= null;
            $message = null;
            $sendername=null;
            $senderIMG=null;
            $group_id = $c->id;
            $data = \DB::table('messages')->where('group_id',$group_id)
            ->orWhere('group_id','like', $group_id.'%')
            ->orWhere('group_id','like','%'.$group_id.'%')
            ->orwhere('group_id','like','%'.$group_id)->orderBy('created_at', 'DESC')->get();
            foreach($data as $d){            
                // $groupid =  array($d->id);
                // $message =  array($d->message);
                // $groupid[] =  $d->id;
                $message[] =  $d->message;
                $sendername[] = User::find($d->sender_id)->real_name;
                $sendertype = User::find($d->sender_id)->user_type;
                if($sendertype == 2){
                    $sendersIMG = DB::table('student_profiles')->where('user_id',$d->sender_id)->first('picture');
                }elseif($sendertype == 3){
                    $sendersIMG = DB::table('staff_profiles')->where('user_id',$d->sender_id)->first('picture');

                }elseif($sendertype == 5){
                    $sendersIMG = DB::table('alumni_profiles')->where('user_id',$d->sender_id)->first('picture');
                }else{  die(); }
                $senderIMG[] =  $sendersIMG->picture;
                // $sendernameImg[] = $sendername.','.$senderIMG;
            // }
                }
                // $user_count = ;
                $user_data = array();
                if($sendername !=null){
                for($i =0; $i < count($sendername); $i++){
                    $user_data[$i] = array(
                        'name' => $sendername[$i],
                        'image' => $senderIMG[$i],
                    ); 
                }
            }
                // $Userdata = array_combine($sendername,$senderIMG);
               
                // try end
            $groupWithMsg[] = array($c->groupname => array_combine($message ?? array(),$user_data ?? array()));        
        }
        // echo "<pre>";
        // print_r($groupWithMsg);
        // echo '</pre>';
        // die();
        // echo '<pre>';
        // print_r($sendername.','.$senderIMG);
        // echo '</pre>';
        // print_r($groupid);
    // die();
        return view('Public.Home.Group.index',compact('addMember','groups','groupWithMsg'));
    }

    public function addGroup(Request $request){
        $validated = $request->validate([
            'groupname' => 'required|unique:groups,groupname|max:255',
            'slug'     => 'required|unique:groups,slug|max:255',
            'members'     => 'required',
        ]);
        // print_r($request->all());
        $members = implode(",",$request->members);
        // print_r($members);
        $group = new group();
        $group->groupname = $request->groupname;
        $group->slug = $request->slug;
        $group->group_members = $members;
        $group->created_by = Auth()->user()->id;
        $group->save();
        return redirect()->back()->with('success','Group added Successfully');
    }



    public function sendMessage(Request $request){
        if($request->message){
            // $group_id = group::where('group_name', $request->grpname)->first();
            $group_id = group::where('groupname', $request->grpname)->pluck('id')->first();
            $message = new message();
            $message->message = $request->message;
            $message->sender_id = Auth::user()->id;
            $message->group_id = $group_id;
            $message->save();
            return response()->json('Message Sent Successfully');
        }else{
            return response()->json('message is empty');
        }
    }

    public function deletegrp(Request $request){
        if($request->grpname){
            $group = group::where('groupname', $request->grpname)->first();
                if($group->created_by == Auth::user()->id){
                    DB::table('groups')->where('id', $group->id)->delete();
                    return response()->json(' deleted Successfully');
                }else{
                    return response()->json('You Can Not Delete This Group');
                }
        }else{
            return response()->json('You Can Not Delete This Group');
        }
    }


    public function addgrpmember(Request $request){
        if($request->groupname){
            $group = group::where('groupname', $request->groupname)->first();
            if($group){
                if($group->created_by == Auth::user()->id){
                    $userId = null;
                    $myCollegeId = null;
                    if(Auth::user()){
            if( Auth::user()->user_type == 2){
                $userId = Auth::user()->id;
                $CollegeId = DB::table('student_profiles')->where('user_id',$userId)->first();
                if($CollegeId){
                        if($CollegeId->college_id){
                            $myCollegeId = $CollegeId->college_id;
                        }else{
                            return redirect('/profile')->with('error', 'Pleace Complete Your Profile First.');
                        }
                }else{
                    return redirect('/profile')->with('error', 'Pleace Complete Your Profile First.');
                }
            }elseif( Auth::user()->user_type == 3){
                $userId = Auth::user()->id;
                $CollegeId = DB::table('staff_profiles')->where('user_id',$userId)->first();
                if($CollegeId){
                        if($CollegeId->college_id){
                            $myCollegeId = $CollegeId->college_id;
                        }else{
                            return redirect('/profile')->with('error', 'Pleace Complete Your Profile First.');
                        }
                }else{
                    return redirect('/profile')->with('error', 'Pleace Complete Your Profile First.');
                }
            }elseif( Auth::user()->user_type == 5){
                $userId = Auth::user()->id;
                $CollegeId = DB::table('alumni_profiles')->where('user_id',$userId)->first();
                if($CollegeId){
                        if($CollegeId->college_graduated_from){
                            $myCollegeId = $CollegeId->college_graduated_from;
                        }else{
                            return redirect('/profile')->with('error', 'Pleace Complete Your Profile First.');
                        }
                }else{
                    return redirect('/profile')->with('error', 'Pleace Complete Your Profile First.');
                }
            }
            else{
                $userId = "not you type";
            }
            }else{
                return redirect('/home')->with('error', 'User Not Found.');
            }
            $SchoolMember = DB::table('student_profiles')->where('college_id',$myCollegeId)->get(['name','id','user_id']);
            $staffMember = DB::table('staff_profiles')->where('college_id',$myCollegeId)->get(['name','id','user_id']);
            $alumniMember = DB::table('alumni_profiles')->where('college_graduated_from',$myCollegeId)->get(['name','id','user_id']);
            $Obj1 = (array) $SchoolMember;
            $Obj2 = (array) $staffMember;
            $Obj3 = (array) $alumniMember;
            $addMember = (array) array_merge_recursive($Obj1, $Obj2 , $Obj3);
    
            return view('Public.Home.Group.addgrpmember',compact('group','addMember'));
    
        }else{
                    return redirect()->back()->with('error', 'Only Admin Can Add Users This Group');
                }
            }else{
                return redirect()->back()->with('error', 'Only Admin Can Add Users This Group');
            }
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }


    public function newmembers(Request $request){
        $validated = $request->validate([
            'members'     => 'required',
        ]);
        if($request->members){
            $members = implode(",",$request->members);
            group::where('id', $request->groupid)->update(['group_members' => $members]);
            return redirect()->back()->with('success', 'Update Successfully');
        }else{
            return redirect()->back()->with('error', 'Select Some Member For Group');
        }
    }
}