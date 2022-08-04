<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preference;
use App\Models\LanguageDetails;
use Auth;

class PreferenceController extends Controller
{
    public function addLanguageDetails(Request $request){
        $exist=LanguageDetails::where('user_id',Auth::user()->id)->where('language',$request->language)->get();
        if(!sizeOf($exist)){
            LanguageDetails::create([
                'user_id'=>Auth::user()->id,
                'language'=>$request->language,
                'proficiency'=>$request->proficiency,
                'status'=>'0'
            ]);
        }
        else{
            return [['error'=>'Already Exist']];
        }

        $data=LanguageDetails::where('user_id',Auth::user()->id)->get();
        return $data;
    }

    public function deleteLanguage($id){
        $id=base64_decode($id);
        LanguageDetails::where('id',$id)->delete();
        $specialization_data=LanguageDetails::where('user_id',Auth::user()->id)->get();
        return $specialization_data;
    }

    public function addPreference(Request $request){
        $exist=Preference::where('user_id',Auth::user()->id)->get();
        if(!sizeOf($exist)){
            Preference::create([
                'user_id'=>Auth::user()->id,
                "paper_setter"=>$request->paper_setter,
                "interview"=>$request->interview,
                "line_1"=>$request->line_1,
                "line_2"=>$request->line_2,
                "pincode"=>$request->pin_code,
                "state"=>$request->state,
                "district"=>$request->district,
                "brief"=>$request->brief,
                "enquiry"=>$request->enquiry,
                'status'=>'1'
            ]);
        }
        else{
            Preference::where('user_id',Auth::user()->id)->update([
                "paper_setter"=>$request->paper_setter,
                "interview"=>$request->interview,
                "line_1"=>$request->line_1,
                "line_2"=>$request->line_2,
                "pincode"=>$request->pin_code,
                "state"=>$request->state,
                "district"=>$request->district,
                "brief"=>$request->brief,
                "enquiry"=>$request->enquiry,
                'status'=>'1'
            ]);
        }
        LanguageDetails::where('user_id',Auth::user()->id)->update([
            'status'=>'1'
        ]);
    }
}
