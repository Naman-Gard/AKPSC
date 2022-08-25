<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appoint;
use App\Models\User;
use App\Models\FinalStatus;
use App\Models\Experience;

class AppointController extends Controller
{
    public function index(Request $request){
        // $unique=uniquecodeGenerator();
        Appoint::create([
            // 'expert_id'=>$unique,
            'user_id'=>$request->user_id,
            'from'=>$request->from,
            'to'=>$request->to,
        ]);

        FinalStatus::where('user_id',$request->user_id)->update([
            'appointed'=>1
        ]);

        return redirect()->route('empanelled-users')->with('success','Expert appointed successfully');
    }

    public function getUsers(){
        $users=User::where('type','user')->join('final_statuses','final_statuses.user_id','=','users.id')
        ->join('specializations','specializations.user_id','=','users.id')
        ->join('empanelments','empanelments.user_id','=','users.id')
        // ->join('appoints','appoints.user_id','=','users.id')
        ->where('final_statuses.status','1')
        ->where('final_statuses.empanelled','1')
        ->where('final_statuses.blacklisted','0')
        ->where('final_statuses.appointed','1')
        ->get()->groupBy('user_id');
        $experiences=Experience::get()->groupBy('user_id');
        $appoints=Appoint::get()->groupBy('user_id');
        
        foreach($users as $user_key=>$user){
            $subjects=[];
            $specializations=[];
            $super_specializations=[];
            $dates=[];
            foreach($user as $key=>$subject){
                $temp_subjects=explode(',',$subject['subject']);
                $temp_specializations=explode(',',$subject['specialization']);
                $temp_super_specializations=explode(',',$subject['super_specialization']);
                foreach($temp_subjects as $sub){
                    if(!in_array($sub,$subjects)){
                        array_push($subjects,$sub);
                    }
                }
                foreach($temp_specializations as $sub){
                    if(!in_array($sub,$specializations)){
                        array_push($specializations,$sub);
                    }
                }
                foreach($temp_super_specializations as $sub){
                    if(!in_array($sub,$super_specializations)){
                        array_push($super_specializations,$sub);
                    }
                }
            }
            $users[$user_key]=$users[$user_key][0];
            $users[$user_key]['subject']=$subjects;
            $users[$user_key]['specialization']=$specializations;
            $users[$user_key]['super_specialization']=$super_specializations;
            $users[$user_key]['experience']=sizeOf($experiences) ? $experiences->has($user_key)?$experiences[$user_key]:[] :[];
            $users[$user_key]['appoint']=sizeOf($appoints) ? $appoints->has($user_key)?$appoints[$user_key]:[] : [];
        }

        return view('admin.users.appointed',compact('users'));
    }
}
