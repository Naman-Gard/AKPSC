<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Session;

class AdminController extends Controller
{
    public function dashboard(){
        $users=User::where('type','user')->get();
        $registered=User::where('type','user')->count();
        $empanelled=User::where('type','user')->count();
        $blacklist=User::where('type','user')->count();
        // dd($registered);
        return view('admin.index',compact('users'));
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
