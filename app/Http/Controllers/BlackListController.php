<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserStatus;
use App\Models\BlackListed;

class BlackListController extends Controller
{
    public function index(Request $request){

        $year=date('Y');
        date_default_timezone_set('Asia/Kolkata');

        if($request->lifespan!=='lifetime'){
            BlackListed::create([
                'user_id'=>$request->user_id,
                'years'=>$request->lifespan,
                'lifespan'=>(int)$request->lifespan + (int)$year
            ]);
        }
        else{
            BlackListed::create([
                'user_id'=>$request->user_id,
                'years'=>$request->lifespan,
                'lifespan'=>$request->lifespan
            ]);
        }
        

        UserStatus::where('user_id',$request->user_id)->update([
            'blacklisted'=>1
        ]);

        return redirect()->route('dashboard');
    }
}
