<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        User::create([
        'name' => $request->name,
        'father_name' => $request->father_name,
        'gender' => $request->gender,
        'email' => $request->reg_email,
        'mobile' => $request->mobile,
        'category' => $request->category,
        'dob' => $request->dob,
        'password' => Hash::make(base64_decode($request->pass))
        ]);
        $credentials=['email'=>$request->reg_email,'password'=>base64_decode($request->pass)];
        Auth::attempt($credentials);
        return Redirect()->route('fill-details')->with('success','User Registered Successfully');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        foreach($credentials as $key=>$item){
            if($key=="password"){
                $credentials[$key]=base64_decode($item);
            }
        }
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            return Redirect()->route('fill-details')->with('success','Login Successfully');
        }
        return redirect()->back()->with('fail','Invalid Credentials');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('/')->with('success','Logout Sucessfully');
    }

    public function isEmailRegistered($email){
        $status=User::where('email',$email)->get();
        if(sizeOf($status)){
            return ['status'=>'Already Exist'];
        }
        else{
            return ['status'=>'Not Registered'];
        }
    }

    public function sendOtp($email,$otp){
        $otp=base64_decode($otp);
        $email=base64_decode($email);
        
        Mail::to($email)->send(new OtpMail($otp));

        if(Mail::failures($email)){
            return response(0);
        }
        else{
            return response(1);
        }
    }
}