<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FinalStatus;
use Auth;

class ProfileController extends Controller
{
    public function index(){
        $exist=FinalStatus::where('user_id',Auth::user()->id)->where('status','1')->get();
        if(!sizeOf($exist)){
            return redirect()->route('preview');
        }
        else{
            $user=User::where('id',Auth::user()->id)->first();
            return view('profile.index',compact('user'));
        }
    }
}
