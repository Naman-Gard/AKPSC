<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FinalStatus;
use App\Models\Experience;
use App\Models\LanguageDetails;
use App\Models\Appoint;
use App\Models\Education;
use Auth;
use Session;
use DB;
use App\Models\BlackListed;

class AdminController extends Controller
{
    public function dashboard(){

        $year=date('Y');
        date_default_timezone_set('Asia/Kolkata');

        $users=BlackListed::where('lifespan',$year)->select('user_id')->get()->toArray();
        BlackListed::where('lifespan',$year)->delete();
        FinalStatus::whereIn('user_id',$users)->update([
            'blacklisted'=>0
        ]);

        $registered=User::where('type','user')->count();
        $empanelled=FinalStatus::where('empanelled','1')->where('blacklisted','0')->count();
        $blacklist=FinalStatus::where('blacklisted','1')->count();

        $count=array(
            "register"=>$registered,
            "empanell"=>$empanelled,
            "blacklist"=>$blacklist
        );
        $subjects=DB::table('subject_master')->orderBy('subject_list')->get();

        return view('admin.index',compact('count','subjects'));
    }

    public function logout(){
        Session::forget('admin-user');
        return redirect()->route('secure-admin')->with('success','Logout Sucessfully');
    }

    public function login(Request $request){
        $email=$request->email;
        $password=base64_decode($request->password);
        $user=User::where('email',$email)->where('type','admin')->first();
        if($user){
            if(password_verify($password, $user->password)){
                Session::put('admin-user',$user);
                return Redirect()->route('dashboard');       
            }
            else{
                return redirect()->route('secure-admin')->with('success','Invalid Credentials');        
            }
        }
        else{
            return redirect()->route('secure-admin')->with('success','Invalid Credentials');        
        }
    }

    public function getUsers(){
        $users=User::where('type','user')->join('final_statuses','final_statuses.user_id','=','users.id')
        ->join('specializations','specializations.user_id','=','users.id')
        ->where('final_statuses.status','1')
        ->where('final_statuses.empanelled','0')
        ->where('final_statuses.blacklisted','0')
        ->get()->groupBy('user_id');
        $experiences=Experience::get()->groupBy('user_id');
        // dd($experiences);
        
        foreach($users as $user_key=>$user){
            $subjects=[];
            $specializations=[];
            $super_specializations=[];
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
            $users[$user_key]['experience']=$experiences[$user_key]?$experiences[$user_key]:'';
        }

        return $users;
    }

    public function getRegisteredUser(){
        $users=User::join('final_statuses','final_statuses.user_id','=','users.id')
        ->join('specializations','specializations.user_id','=','users.id')
        ->where('final_statuses.status','1')
        ->where('type','user')->get()->groupBy('user_id');

        $experiences=Experience::get()->groupBy('user_id');
        
        foreach($users as $user_key=>$user){
            $subjects=[];
            $specializations=[];
            $super_specializations=[];
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
        }
        return view('admin.users.registered',compact('users'));
    }

    public function getEmpanelledUser(){
        $users=User::where('type','user')->join('final_statuses','final_statuses.user_id','=','users.id')
        ->join('specializations','specializations.user_id','=','users.id')
        ->join('empanelments','empanelments.user_id','=','users.id')
        // ->join('appoints','appoints.user_id','=','users.id')
        ->where('final_statuses.status','1')
        ->where('final_statuses.empanelled','1')
        ->where('final_statuses.blacklisted','0')
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

        return view('admin.users.empanelled',compact('users'));
    }

    public function getBlacklistedUser(){
        $users=User::join('final_statuses','final_statuses.user_id','=','users.id')
        ->join('empanelments','empanelments.user_id','=','users.id')
        ->join('specializations','specializations.user_id','=','users.id')
        ->where('type','user')->where('final_statuses.blacklisted',1)->get()->groupBy('user_id');

        foreach($users as $user_key=>$user){
            $subjects=[];
            $specializations=[];
            $super_specializations=[];
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
        }
        return view('admin.users.blacklisted',compact('users'));
    }

    public function getReport(){
        $subjects=DB::table('subject_master')->orderBy('subject_list')->get();
        $qualification=DB::table('qualification_master')->get()->groupBy('qual_name');

        return view('admin.download-data.index',compact('subjects','qualification'));
    }

    public function getReportUsers(){
        $empanelled_users=User::where('type','user')->join('final_statuses','final_statuses.user_id','=','users.id')
        ->join('specializations','specializations.user_id','=','users.id')
        ->join('empanelments','empanelments.user_id','=','users.id')
        ->join('preferences','preferences.user_id','=','users.id')
        ->join('is_workings','is_workings.user_id','=','users.id')
        ->where('final_statuses.status','1')
        ->where('final_statuses.empanelled','1')
        ->where('final_statuses.blacklisted','0')
        ->select('users.*','users.created_at as from','empanelments.*','final_statuses.*','specializations.*','preferences.*','is_workings.*')
        ->get()->groupBy('user_id');

        $registered_users=User::where('type','user')->join('final_statuses','final_statuses.user_id','=','users.id')
        ->join('specializations','specializations.user_id','=','users.id')
        ->join('preferences','preferences.user_id','=','users.id')
        ->join('is_workings','is_workings.user_id','=','users.id')
        ->where('final_statuses.status','1')
        ->where('final_statuses.empanelled','0')
        ->where('final_statuses.blacklisted','0')
        ->select('users.*','users.created_at as from','final_statuses.*','specializations.*','preferences.*','is_workings.*')
        ->get()->groupBy('user_id');

        $experiences=Experience::get()->groupBy('user_id');
        $languages=LanguageDetails::get()->groupBy('user_id');
        $qualification=Education::get()->groupBy('user_id');
        $appoints=Appoint::get()->groupBy('user_id');
        
        foreach($empanelled_users as $user_key=>$user){
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
            $empanelled_users[$user_key]=$empanelled_users[$user_key][0];
            $empanelled_users[$user_key]['subject']=$subjects;
            $empanelled_users[$user_key]['specialization']=$specializations;
            $empanelled_users[$user_key]['super_specialization']=$super_specializations;
            $empanelled_users[$user_key]['experience']=sizeOf($experiences) ? $experiences->has($user_key)?$experiences[$user_key]:[] :[];
            $empanelled_users[$user_key]['language']=sizeOf($languages) ? $languages->has($user_key)?$languages[$user_key]:[] :[];
            $empanelled_users[$user_key]['qualification']=sizeOf($qualification) ? $qualification->has($user_key)?$qualification[$user_key]:[] :[];
            $empanelled_users[$user_key]['appoint']=sizeOf($appoints) ? $appoints->has($user_key)?$appoints[$user_key]:[] : [];
        }
        foreach($registered_users as $user_key=>$user){
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
            $registered_users[$user_key]=$registered_users[$user_key][0];
            $registered_users[$user_key]['subject']=$subjects;
            $registered_users[$user_key]['specialization']=$specializations;
            $registered_users[$user_key]['super_specialization']=$super_specializations;
            $registered_users[$user_key]['experience']=sizeOf($experiences) ? $experiences->has($user_key)?$experiences[$user_key]:[] :[];
            $registered_users[$user_key]['language']=sizeOf($languages) ? $languages->has($user_key)?$languages[$user_key]:[] :[];
            $registered_users[$user_key]['qualification']=sizeOf($qualification) ? $qualification->has($user_key)?$qualification[$user_key]:[] :[];
            $registered_users[$user_key]['appoint']=sizeOf($appoints) ? $appoints->has($user_key)?$appoints[$user_key]:[] : [];
        }

        $users=$empanelled_users->merge($registered_users);
        return $users;
    }
}
