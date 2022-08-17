<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserStatus;
use App\Models\Experience;
use Auth;
use Session;

class AdminController extends Controller
{
    public function dashboard(){
        $users=User::where('type','user')->join('user_statuses','user_statuses.user_id','=','users.id')->join('specializations','specializations.user_id','=','users.id')->get()->groupBy('user_id');
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
        $registered=User::where('type','user')->count();
        $empanelled=UserStatus::where('empanelled','1')->count();
        $blacklist=UserStatus::where('blacklisted','1')->count();

        $count=array(
            "register"=>$registered,
            "empanell"=>$empanelled,
            "blacklist"=>$blacklist
        );

        return view('admin.index',compact('users','count'));
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
                return Redirect()->route('dashboard')->with('success','Login Successfully');       
            }
            else{
                return redirect()->route('secure-admin')->with('success','Invalid Credentials');        
            }
        }
        else{
            return redirect()->route('secure-admin')->with('success','Invalid Credentials');        
        }


        // $credentials = $request->only('email', 'password');
        // foreach($credentials as $key=>$item){
        //     if($key=="password"){
        //         $credentials[$key]=base64_decode($item);
        //     }
        // }
        // $credentials['type']='admin';
        // // dd($credentials);
        // if (Auth::attempt($credentials)) {
        //     return Redirect()->route('dashboard')->with('success','Login Successfully');
        // }
        // return redirect()->route('secure-admin')->with('success','Invalid Credentials');
    }
}
