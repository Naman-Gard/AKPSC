<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinalStatus;
use App\Models\BlackListed;
use App\Models\Appoint;

class BlackListController extends Controller
{
    public function index(Request $request){

        $year=date('Y');
        date_default_timezone_set('Asia/Kolkata');

        if($request->lifespan!=='lifetime'){
            BlackListed::create([
                'user_id'=>$request->user_id,
                'years'=>$request->n_years,
                'lifespan'=>(int)$request->n_years + (int)$year
            ]);
        }
        else{
            BlackListed::create([
                'user_id'=>$request->user_id,
                'years'=>0,
                'lifespan'=>$request->lifespan
            ]);
        }
        

        FinalStatus::where('user_id',$request->user_id)->update([
            'blacklisted'=>1,
            'appointed'=>0
        ]);

        Appoint::where('user_id',$request->user_id)->delete();

        return redirect()->route('empanelled-users')->with('success','Expert blacklisted successfully');
    }

    public function removeUser($id){
        FinalStatus::where('user_id',$id)->update([
            'blacklisted'=>0
        ]);
        BlackListed::where('user_id',$id)->delete();
        return redirect()->route('blacklisted-users');
    }
}
