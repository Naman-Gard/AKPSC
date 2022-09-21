<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FinalStatus;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Hash;
use Auth;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function register(Request $request){
        if(isset($request->verified)){
            $otp=explode('_',base64_decode($request->verified));
            if(isset($otp[1])){
                if($otp[1]===$request->otp){
                    $user=User::create([
                        'name' => ucwords($request->name),
                        'father_name' => ucwords($request->father_name),
                        'gender' => $request->gender,
                        'email' => $request->reg_email,
                        'mobile' => $request->mobile,
                        'category' => $request->category,
                        'dob' => $request->dob,
                        'type'=>'user',
                        'password' => Hash::make(base64_decode($request->pass))
                    ]);
                    
                    $flag=true;
            
                    do {
                        $unique=uniquecodeGenerator();
                        $uniqueExist = FinalStatus::where('register_id',$unique)->get();
                        if(!sizeOf($uniqueExist)){
                            $flag=false;
                        }
                    }
                    while ($flag);
                    
                    FinalStatus::create([
                        'user_id'=>$user->id,
                        'register_id'=>$unique,
                        'status'=>0,
                        'empanelled'=>0,
                        'blacklisted'=>0,
                        'appointed'=>0,
                        'dor'=>''
                    ]);
            
                    $credentials=['email'=>$request->reg_email,'password'=>base64_decode($request->pass)];
                    Auth::attempt($credentials);
            
                    $message='Dear Applicant,%0a';
                    $message.='your registration is completed, kindly complete your application using your emailid or user id '.$request->reg_email.' and password.%0a';
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
                            "template_id"=>env('REGC_TEMPLATE_ID'),
                            "format"=>"json",
                            'message'=>$message,
                            'to'=>$request->mobile
                        ]
                    ]);
                    return Redirect()->route('fill-details')->with('success','User Registered Successfully');
                }
            }
        }
        return Redirect()->route('/')->with('success','Invalid Registration');
    }

    public function login(Request $request){
        if ($request->captcha_code !== $request->captcha) {
            return redirect()->route('/')->with('success', 'Captcha is not correct');
        }
        $credentials = $request->only('email', 'password');
        foreach($credentials as $key=>$item){
            if($key=="password"){
                $credentials[$key]=base64_decode(base64_decode(base64_decode($item)));
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

    public function isEmailRegistered($data){
        $data=json_decode(base64_decode($data));
        if(isset( $data->type )){
            $email=$data->email;
            $status=User::where('email',$email)->get();
            if(sizeOf($status)){
                return ['status'=>'Already Exist'];
            }
            else{
                return ['status'=>'Not Registered'];
            }
        }
        else{
            if(isset( $data->email) && isset( $data->mobile) && isset( $data->name) && isset( $data->father_name) && isset( $data->dob)){
                $email=$data->email;
                $mobile=$data->mobile;
                $name=$data->name;
                $father_name=$data->father_name;
                $dob=$data->dob;
        
                $status=User::where('email',$email)->get();
                $mobileStatus=User::where('mobile',$mobile)->get();
                $userStatus=User::where('name',$name)
                ->where('father_name',$father_name)
                ->where('dob',$dob)
                ->get();
        
                if(sizeOf($userStatus)){
                    return ['status'=>'User Already Exist'];
                }
                else if(sizeOf($status) && sizeOf($mobileStatus)){
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
        }
    }

    public function sendOtp(Request $request){
        $data=json_decode(base64_decode($request->data));
        if(isset($data->email) && isset($data->mobile) && isset($data->otp)){
            $email=$data->email;
            $mobile=$data->mobile;
            $otp=$data->otp;
            
            $subject = "UKPSC - Registration OTP";
            // $body = "Below is your One Time Password(OTP) for registration. ".$otp;
            // // $body .= $otp;
            // $headers = "From: stagtbny@premium215.web-hosting.com";
            // mail($email, $subject, $body, $headers);
            // Mail::to($email)->send(new OtpMail($otp));
    
            // if(Mail::failures($email)){
            //     return response(0);
            // }
            // else{
            //     return response(1);
            // }
    
            $message='Dear Applicant,%0a';
            $message.='your One Time Password (OTP) for registration is '. $otp. ' (Valid for 5 mins).%0a';
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
                    "template_id"=>env('REG_TEMPLATE_ID'),
                    "format"=>"json",
                    'message'=>$message,
                    'to'=>$mobile
                ]
            ]);

            $message=str_replace('%0a','<br>',$message);
            
            $res1 = $client->request('POST', 'http://hmiemail.in/pushemail.php', [
                'form_params' => [
                    "username"=>env('MAIL_NY_USERNAME'),
                    "api_password"=>env('MAIL_NY_PASSWORD'),
                    "sender"=>env('MAIL_NY_SENDER'),
                    "replyto"=>env('MAIL_NY_REPLY'),
                    "cright"=>env('MAIL_CRIGHT'),
                    "display"=>env('MAIL_DISPLAY'),
                    'subject'=>$subject,
                    'message'=>$message,
                    'to'=>$email
                ]
            ]);
    
            return ['success'=>'OTP send successfully'];
        }
    }

    public function sendResetLink(Request $request,$email){
        $email=base64_decode($email);
        $email=base64_encode($email);
        $date=base64_encode(date('Y-m-d'));
        date_default_timezone_set('Asia/Kolkata');
        $time=base64_encode(date('h:i:s'));
        
        $link=url('/').'/token='.$email.'/'.$date.'/'.$time;
        $user=User::where('email',base64_decode($email))->first();
        if($user){
            $data=User::where('email',base64_decode($email))->update([
                'remember_token'=>'true',
            ]);
            // dd($link);

            $subject = "UKPSC - Reset Link";
            // $body = "Below is your Reset Link for change Password.";
            // $body .= "$link";
            // $headers = "From: stagtbny@premium215.web-hosting.com";
            // mail(decode5t($email), $subject, $body, $headers);
            // dd($link);
            // Mail::to($email)->send(new ResetLinkMail($link));
            $message='Dear Applicant,%0a';
            $message.='Kindly reset your password using the following link. '.$link.'%0a';
            $message.='Regards%0a';
            $message.='UKPSC';

            $client = new Client();
            $res = $client->request('POST', 'http://sms.holymarkindia.in/API/WebSMS/Http/v1.0a/index.php', [
                'form_params' => [
                    "username"=>env('NY_USERNAME'),
                    "password"=>env('NY_PASSWORD'),
                    "sender"=>env('NY_SENDER'),
                    "pe_id"=>env('NY_PE_ID'),
                    "reqid"=>env('NY_REQ_ID'),
                    "template_id"=>env('RESET_TEMPLATE_ID'),
                    "format"=>"json",
                    'message'=>$message,
                    'to'=>$user->mobile
                ]
            ]);

            $message=str_replace('%0a','<br>',$message);
            
            $res1 = $client->request('POST', 'http://hmiemail.in/pushemail.php', [
                'form_params' => [
                    "username"=>env('MAIL_NY_USERNAME'),
                    "api_password"=>env('MAIL_NY_PASSWORD'),
                    "sender"=>env('MAIL_NY_SENDER'),
                    "replyto"=>env('MAIL_NY_REPLY'),
                    "cright"=>env('MAIL_CRIGHT'),
                    "display"=>env('MAIL_DISPLAY'),
                    'subject'=>$subject,
                    'message'=>$message,
                    'to'=>$user->email
                ]
            ]);
            
            return ['status'=>"Success"];
        }
        else{
            return ["status"=>"Unauthorized User"];
        }
    }

    public function viewReset($email,$date,$time){
        $email=base64_decode($email);
        $date=base64_decode($date);
        $time=base64_decode($time);

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
        
        $email=base64_decode($email);
        
        User::where('email',$email)->update([
            'password'=>Hash::make($request->password),
            'remember_token'=>'false'
        ]);
        return redirect()->route('/')->with('success','Password is successfully reset');
    }
}