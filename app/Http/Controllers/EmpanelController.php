<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinalStatus;
use App\Models\Empanelment;

class EmpanelController extends Controller
{
    public function addEmpanel(Request $request){

        $flag=true;
        do {
            $unique=uniquecodeGenerator();
            $uniqueExist = Empanelment::where('empanelment_id',$unique)->get();
            if(!sizeOf($uniqueExist)){
                $flag=false;
            }
        }
        while ($flag);

        Empanelment::create([
            'empanelment_id'=>$unique,
            'user_id'=>$request->user_id,
            'file_number'=>$request->file_number,
            'date_of_empanel'=>$request->doe,
            'secret_code1'=>$request->secret_code1,
            'secret_code2'=>$request->secret_code2
        ]);

        FinalStatus::where('user_id',$request->user_id)->update([
            'empanelled'=>1
        ]);

        return redirect()->route('dashboard')->with('success','Expert empanell successfully with empanelled id: '.$unique);
    }
}
