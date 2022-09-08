<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\User;
use GuzzleHttp\Client;
use Hash;

class SuperAdminController extends Controller
{

    public function checkCredentials($data){
        $data=json_decode(base64_decode($data));
        if(isset($data->email) && isset($data->password)){
            $email=$data->email;
            $password=base64_decode($data->password);
            $user=User::where('email',$email)->where('type','super-admin')->first();
            if($user){
                if(password_verify($password, $user->password)){
                    return ['status'=>'Valid Credentials','data'=>base64_encode($user->mobile)];       
                }
                else{
                    return ['status'=>'Invalid Credentials'];        
                }
            }
            else{
                return ['status'=>'Invalid Credentials'];        
            }
        }
    }

    public function sendOTP($mobile,$OTP){
        $exist=User::where('mobile',base64_decode($mobile))->where('type','super-admin')->get();
        if(sizeof($exist)){
            $message='Dear User%0a';
            $message.='One Time Password(OTP) for login is '.base64_decode($OTP).'%0a';
            $message.='Regards,%0a';
            $message.='UKPSC';
    
            $client = new Client();
            $res = $client->request('POST', 'http://sms.holymarkindia.in/API/WebSMS/Http/v1.0a/index.php', [
                'form_params' => [
                    "username"=>env('NY_USERNAME'),
                    "password"=>env('NY_PASSWORD'),
                    "sender"=>env('NY_SENDER'),
                    "pe_id"=>env('NY_PE_ID'),
                    "reqid"=>env('NY_REQ_ID'),
                    "template_id"=>env('LOGIN_TEMPLATE_ID'),
                    "format"=>"json",
                    'message'=>$message,
                    'to'=>base64_decode($mobile)
                ]
            ]);
    
            return ['success'=>'OTP send successfully'];
        }
    }

    public function login(Request $request){
        $email=$request->email;
        $password=base64_decode($request->password);
        $user=User::where('email',$email)->where('type','super-admin')->first();
        if($user){
            if(password_verify($password, $user->password)){
                Session::put('super-admin',$user);
                return Redirect()->route('superadmin-dashboard');       
            }
            else{
                return redirect()->route('secure-superadmin')->with('success','Invalid Credentials');        
            }
        }
        else{
            return redirect()->route('secure-superadmin')->with('success','Invalid Credentials');        
        }
    }

    public function logout(){
        Session::forget('super-admin');
        return redirect()->route('secure-superadmin')->with('success','Logout Sucessfully');
    }

    public function dashboard(){
        $users=User::where('type','admin')->get();
        return view('super-admin.dashboard.index',compact('users'));
    }

    public function isEmailRegistered($data){
        $data=json_decode(base64_decode($data));
        $email=$data->email;
        $mobile=$data->mobile;
        if($data->status!=='0'){
            $status=User::where('email',$email)->where('id','!=',$data->status)->get();
            $mobileStatus=User::where('mobile',$mobile)->where('id','!=',$data->status)->get();
        }
        else{
            $status=User::where('email',$email)->get();
            $mobileStatus=User::where('mobile',$mobile)->get();
        }

        if(sizeOf($status) && sizeOf($mobileStatus)){
            return ['status'=>'Already Exist'];
        }
        else if(sizeOf($status)){
            return ['status'=>'Email Already Exist'];
        }
        else if(sizeOf($mobileStatus)){
            return ['status'=>'Mobile Already Exist'];
        }
        else{
            return ['status'=>'Not Registered'];
        }
    }

    public function addSection(Request $request){

        $user=User::insert([
        'name' => ucwords($request->name),
        'father_name' => 'Admin',
        'gender' => 'Admin',
        'email' => $request->email,
        'mobile' => $request->mobile,
        'category' => 'Admin',
        'dob' => 'Admin',
        'type'=>'admin',
        'password' => Hash::make($request->password)
        ]);

        return redirect()->route('superadmin-dashboard')->with('success','Section Added Sucessfully');
    }

    public function removeSection($id){
        User::where('id',decode5t($id))->delete();
        return redirect()->route('superadmin-dashboard')->with('success','Section Removed Sucessfully');
    }

    public function editSection($id){
        $user=User::where('type','admin')->where('id',decode5t($id))->first();
        return view('super-admin.dashboard.edit',compact('user'));
    }

    public function saveSection(Request $request){
        if(!is_null($request->password)){
            $user=User::where('id',$request->id)->update([
            'name' => ucwords($request->name),
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password)
            ]);
        }
        else{
            $user=User::where('id',$request->id)->update([
            'name' => ucwords($request->name),
            'email' => $request->email,
            'mobile' => $request->mobile
            ]);
        }

        return redirect()->route('superadmin-dashboard')->with('success','Section Updated Sucessfully');
    }

    public function profile(){
        return view('super-admin.profile.index');        
    }

    public function updateProfile(Request $request){
        if(!is_null($request->password)){
            $user=User::where('id',$request->id)->update([
            'name' => ucwords($request->name),
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password)
            ]);
        }
        else{
            $user=User::where('id',$request->id)->update([
            'name' => ucwords($request->name),
            'email' => $request->email,
            'mobile' => $request->mobile
            ]);
        }

        $user=User::where('id',$request->id)->first();
        Session::put('super-admin',$user);

        return redirect()->route('superadmin-dashboard')->with('success','Profile Updated Sucessfully');
    }
   
}
