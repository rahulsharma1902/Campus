<?php

namespace App\Http\Controllers\Public\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\college_name;
use App\Models\college_page;
use App\Models\alumni_profile;
use App\Models\staff_profile;
use App\Models\joinPage;
use App\Models\User;
use App\Models\post;
use App\Models\group;
use App\Models\message;
use App\Models\event;
use App\Models\event_guest;
use App\Models\sponsership;
use Session;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class EventController extends Controller
{
    public function index(){
       
        
        if(Auth::user()){
        $event_request = DB::table('event_guests')->where('user_id',Auth::user()->id)->get();
        foreach($event_request as $er){
            // print_r($er->event_id);
            $events[] = DB::table('events')->where('id',$er->event_id)->get(); 
        }
        }else{
            $events = null;
        }
        return view('Public.Home.Events.index',compact('events'));
    }

    public function createevent(){
        $Colleges = college_name::all();
        return view('Public.Home.Events.CreateEvent', compact('Colleges'));
    }
    public function saveevent(Request $request){
        // print_r($request->all());
        $validated = $request->validate([
            'event_name' => ['required'],
            'slug'         => ['required',Rule::unique('events', 'slug')],
        ]);
        // print_r($request->all());
        if($validated){
        $event = new event();
        $event->event_creator = Auth::user()->id;
        $event->event_name = $validated['event_name'];
        $event->slug = $validated['slug'];
        $event->event_date = $request['event_date'];
        $event->event_time = $request['event_time'];
        $event->event_venue = $request['event_venue'];
        $event->sponsership_needed = $request['sponsership_needed'];
        $event->event_cost = $request['event_cost'];
        $event->guest_request = implode(",",$request->guest_request);
        $event->event_guestNumber = $request['event_guestNumber'];
        $event->status = 1;
        $event->save();
        /** Send Join Request To Select College */
                $event_id = DB::table('events')->where('slug',$validated['slug'])->first('id');
                // print_r($event_id->id);
                foreach($request->guest_request as $key => $college_id){
                    $college = college_name::find($college_id)->first();
                        $SchoolMember = DB::table('student_profiles')->where('college_id',$college_id)->get(["user_id"]);
                        $staffMember = DB::table('staff_profiles')->where('college_id',$college_id)->get(["user_id"]);
                        $alumniMember = DB::table('alumni_profiles')->where('college_graduated_from',$college_id)->get(["user_id"]);
                    //    print_r(count($SchoolMember));
                    if(count($SchoolMember) != 0){
                       for($i=0;$i<count($SchoolMember);$i++){
                        $event_guest = new event_guest();
                            $event_guest->user_id = $SchoolMember[$i]->user_id;
                            $event_guest->event_id = $event_id->id;
                            $event_guest->save();
                            
                       }
                    } 
                    if(count($staffMember) != 0){
                        for($i=0;$i<count($staffMember);$i++){
                            $event_guest = new event_guest();
                            $event_guest->user_id = $staffMember[$i]->user_id;
                            $event_guest->event_id = $event_id->id;
                            $event_guest->save();

                        }
                     }  
                     if(count($alumniMember) != 0){
                        for($i=0;$i<count($alumniMember);$i++){
                            $event_guest = new event_guest();
                            $event_guest->user_id = $alumniMember[$i]->user_id;
                            $event_guest->event_id = $event_id->id;
                            $event_guest->save();
                        }
                     }  
                }


            return redirect()->back()->with('success', 'Event added');
        }

    }
    public function eventrequests(){
        // $event_request = new event_guest();
        $event_request = DB::table('event_guests')
        ->where('user_id', '=', Auth::user()->id)
        ->where('status', '=', 0)
        ->get();
        // print_r(count($event_request));
        
        $event = array();
        if(count($event_request) > 0){
        foreach($event_request as $event_request){
            // echo $event_request->event_id;
            $event[] = event::find($event_request->event_id)->first();
        }
        // echo '<pre>';
        // print_r($event);
        // echo '</pre>';
        // print_r(count($event));
        // die();
        return view('Public.Home.Events.eventrequests',compact('event'));
    }
    return view('Public.Home.Events.eventrequests',compact('event'));

    }
    public function acceptevent(Request $request){
        if($request->event_id){
            DB::table('event_guests')->where('event_id', $request->event_id)
            ->where('user_id', '=', Auth::user()->id)
            ->update(['status' => 1]);
            return response()->json([$request->event_id]);
        }else{
            return response()->json(['Failed to Accept Event']);
        }
        return response()->json(['Failed to Accept Event']);

    }
    public function declineevent(Request $request){
        if($request->event_id){
            DB::table('event_guests')->where('event_id', $request->event_id)
            ->where('user_id', '=', Auth::user()->id)
            ->delete();
            return response()->json(['Invitation Declined']);
        }else{
  
            return response()->json(['Failed to Declined']);
         }
         return response()->json([$request->event_id]);

    }
    public function sponsorrequest(Request $request){
            // print_r($request->all());
            $request->validate([
                'name' => 'required',
                'email' =>'required',
                'phone' => 'required',
                'amount' => 'required',
                'reason' => 'required'
            ]);
            if($request->id == null){
            $sponsorship = new sponsership();
            $sponsorship->name = $request->name;
            $sponsorship->email = $request->email;
            $sponsorship->amount = $request->amount;
            $sponsorship->reason = $request->reason;
            $sponsorship->event_id = $request->eventid;
            $sponsorship->user_id = $request->userid;
            $sponsorship->host_id = $request->hostid;
            $sponsorship->status = 0;
            $sponsorship->save();

            return redirect('/events');
            }else{
            $sponsorship = sponsership::find($request->id);
            $sponsorship->name = $request->name;
            $sponsorship->email = $request->email;
            $sponsorship->amount = $request->amount;
            $sponsorship->reason = $request->reason;
            $sponsorship->event_id = $request->eventid;
            $sponsorship->user_id = $request->userid;
            $sponsorship->host_id = $request->hostid;
            $sponsorship->status = 0;
            $sponsorship->update();
            return redirect('/events');
            }

    }
    public function Getsponsorshipid(Request $request){
    $data = sponsership::where(['user_id' => $request->userid , 'event_id' => $request->id ,'status' => 0])->first();
    return response()->json($data);
    }
    public function myevents(){
        // print_r(Auth::user()->id);
        $myevents = event::where(['event_creator' => Auth::user()->id,'status' => 1])->get();
        return view('Public.Home.Events.myevents', compact('myevents'));
    }
    public function SponsorRequests(Request $request ){
        if($request->id){
        $sponsorrequests = sponsership::where(['event_id' => $request->id,'status'=>0])->get();
        return response()->json($sponsorrequests);
        }
    }
    public function SponsorRequestaccepted($id){
        if($id !== null){
            $data = sponsership::find($id);
            $data->status = 1;
            $data->update();
           return redirect()->back()->with('success', 'sponsor request accepted');
        }else{
            return redirect()->back()->with('success', 'sponsor request denied cancel');
        }
    }
    public function SponsorRequestdenied($id){
        if($id !== null){
            $data = sponsership::find($id);
            $data->delete();
           return redirect()->back()->with('success', 'sponsor request denied');
        }else{
            return redirect()->back()->with('success', 'sponsor request denied cancel');
        }
    }
    public function try(){
        // $college_id = 6;
        // $college = student_profile::has('collegename')->get();
        // print_r($college);
    }

}