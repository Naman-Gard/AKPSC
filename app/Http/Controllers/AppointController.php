<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appoint;
use App\Models\User;
use App\Models\FinalStatus;

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

        return redirect()->route('empanelled-users');
    }

    public function getUsers(){
        $users=User::where('type','user')->join('final_statuses','final_statuses.user_id','=','users.id')
        ->join('appoints','appoints.user_id','=','users.id')
        ->where('final_statuses.status','1')
        ->where('final_statuses.empanelled','1')
        ->where('final_statuses.appointed','1')
        ->get();
        // dd($users);
        return view('admin.users.appointed',compact('users'));
    }
}
