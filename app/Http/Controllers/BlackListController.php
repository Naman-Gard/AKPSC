<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinalStatus;
use App\Models\BlackListed;

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
            'blacklisted'=>1
        ]);

        return redirect()->route('empanelled-users');
    }

    public function removeUser($id){
        FinalStatus::where('user_id',$id)->update([
            'blacklisted'=>0
        ]);
        BlackListed::where('user_id',$id)->delete();
        return redirect()->route('blacklisted-users');
    }
}
