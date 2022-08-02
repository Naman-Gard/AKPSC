<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\Organization;
use App\Models\IsWorking;
use Auth;

class ExperienceController extends Controller
{
    public function addExperience(Request $request){
        $exist=Experience::where('user_id',Auth::user()->id)->where('type',$request->type)->get();
        if(!sizeOf($exist)){
            Experience::create([
                'user_id'=>Auth::user()->id,
                "type"=>$request->type,
                "year"=>$request->year,
                "specify"=>$request->specify?$request->specify:'-',
                'status'=>'0'
            ]);
        }
        else{
            return [['error'=>'Already Exist']];
        }

        $data=Experience::where('user_id',Auth::user()->id)->get();
        return $data;
    }

    public function deleteExperience($id){
        $id=base64_decode($id);
        Experience::where('id',$id)->delete();
        $data=Experience::where('user_id',Auth::user()->id)->get();
        return $data;
    }

    public function deleteOrganization($id){
        $id=base64_decode($id);
        Organization::where('id',$id)->delete();
        $data=Organization::where('user_id',Auth::user()->id)->get();
        return $data;
    }

    public function addOrganization(Request $request){
        $exist=Organization::where('user_id',Auth::user()->id)->where('org_type',$request->org_type)->where('org_name',$request->org_name)->get();
        if(!sizeOf($exist)){
            Organization::create([
                'user_id'=>Auth::user()->id,
                "org_type"=>$request->org_type,
                "org_name"=>$request->org_name,
                "org_year"=>$request->org_year,
                'status'=>'0'
            ]);
        }
        else{
            return [['error'=>'Already Exist']];
        }

        $data=Organization::where('user_id',Auth::user()->id)->get();
        return $data;
    }

    public function addFinalExperience(Request $request){
        $exist=IsWorking::where('user_id',Auth::user()->id)->get();
        if(sizeOf($exist)){
             IsWorking::where('user_id',Auth::user()->id)->update([
                "isworking"=>$request->isworking,
                "designation"=>$request->designation,
                "serving"=>$request->serving,
                'status'=>'1'
            ]);
        }
        else{
            IsWorking::create([
                'user_id'=>Auth::user()->id,
                "isworking"=>$request->isworking,
                "designation"=>$request->designation,
                "serving"=>$request->serving,
                'status'=>'1'
            ]);
        }

        Experience::where('user_id',Auth::user()->id)->update([
            'status'=>'1'
        ]);

        Organization::where('user_id',Auth::user()->id)->update([
            'status'=>'1'
        ]);
    }
        
}