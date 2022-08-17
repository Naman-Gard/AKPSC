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
        'type'=>'user',
        'password' => Hash::make(base64_decode($request->pass))
        ]);

        // UserStatus::create([
        //     'user_id'
        // ]);
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
        $credentials['type']='user';
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            return Redirect()->route('fill-details')->with('success','Login Successfully');
        }
        return redirect()->route('/')->with('success','Invalid Credentials');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('/')->with('success','Logout Sucessfully');
    }

    public function isEmailRegistered($email){
        $email=base64_decode($email);
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

        $subject = "UKPSC - Registration OTP";
        $body = "Below is your One Time Password(OTP) for registration. /n".$otp;
        // $body .= $otp;
        $headers = "From: stagtbny@premium215.web-hosting.com";
        mail($email, $subject, $body, $headers);
        // Mail::to($email)->send(new OtpMail($otp));

        // if(Mail::failures($email)){
        //     return response(0);
        // }
        // else{
        //     return response(1);
        // }
    }

    public function sendResetLink($email){
        $email=base64_decode($email);
        $email=encode5t($email);
        $date=encode5t(date('Y-m-d'));
        date_default_timezone_set('Asia/Kolkata');
        $time=encode5t(date('h:i:s'));
        
        $link=url('/').'/token='.$email.'/'.$date.'/'.$time;
        $user=User::where('email',decode5t($email))->first();
        if($user){
            $data=User::where('email',decode5t($email))->update([
                'remember_token'=>'true',
            ]);

            $subject = "UKPSC - Reset Link";
            $body = "Below is your Reset Link for change Password.";
            $body .= "$link";
            $headers = "From: stagtbny@premium215.web-hosting.com";
            mail(decode5t($email), $subject, $body, $headers);
            // dd($link);
            // Mail::to($email)->send(new ResetLinkMail($link));
            
            return ['status'=>"Success"];
        }
        else{
            return ["status"=>"Unauthorized User"];
        }
    }

    public function viewReset($email,$date,$time){
        $email=decode5t($email);
        $date=decode5t($date);
        $time=decode5t($time);

        $c_date=date('Y-m-d');
        date_default_timezone_set('Asia/Kolkata');
        $c_time=date('h:i:s');
        $min=(int)round(abs(strtotime($c_time)-strtotime($time))/60);
        if($date==$c_date && $min<=10){
            $user=User::where('email',$email)->first();
            if($user){
                if($user->remember_token=='true'){
                return view('auth.resetPassword.index',compact('email','date','time'));
                }
                else{
                    return redirect()->route('/')->with('success','Reset Link Expired.Generate New Reset Link');
                }
            }
            else{
                return redirect()->route('/')->with('success','Unauthorized User');
            }
        }
        else{
            return redirect()->route('/')->with('success','Reset Link Expired.Generate New Reset Link');
        }
    
   }

    public function successful(Request $request,$email,$date,$time){
        $validator = Validator::make($request->all(),[
            'password'=>'required|confirmed|min:5',
        ]);
        if ($validator->fails()) {
            return redirect()->route('view-reset',[$email,$date,$time])
                    ->withErrors($validator)
                    ->withInput();
        }
        
        $email=decode5t($email);
        
        User::where('email',$email)->update([
            'password'=>Hash::make($request->password),
            'remember_token'=>'false'
        ]);
        return redirect()->route('/')->with('success','Password is successfully reset');
    }
}