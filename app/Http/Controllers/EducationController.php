<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Models\Education;
use Auth;

class EducationController extends Controller
{
    public function addSpecialization(Request $request){
        $exist=Specialization::where('user_id',Auth::user()->id)->where('specialization',$request->specialization)->get();
        if(!sizeOf($exist)){
            Specialization::create([
                'user_id'=>Auth::user()->id,
                "specialization"=>$request->specialization,
                "super_specialization"=>$request->super_specialization,
                "status"=>'0'
            ]);
        }
        else{
            Specialization::where('id',$exist[0]->id)->update([
                'super_specialization'=>$request->super_specialization.','.$exist[0]->super_specialization
            ]);
        }
        
        $specialization_data=Specialization::where('user_id',Auth::user()->id)->get();
        return $specialization_data;
    }

    public function deleteSpecialization($id){
        $id=base64_decode($id);
        Specialization::where('id',$id)->delete();
        $specialization_data=Specialization::where('user_id',Auth::user()->id)->get();
        return $specialization_data;
    }

    public function deleteEducation($id){
        $id=base64_decode($id);
        Education::where('id',$id)->delete();
        $education_data=Education::where('user_id',Auth::user()->id)->get();
        return $education_data;
    }

     public function addEducation(Request $request){
        $exist=Education::where('user_id',Auth::user()->id)->where('degree',$request->degree)->get();
        if(!sizeOf($exist)){
            $subjects=$request->subject;

            if($request->sub1){
                $subjects=$subjects.','.$request->sub1;
            }

            if($request->sub2){
                $subjects=$subjects.','.$request->sub2;
            }

            Education::create([
                'user_id'=>Auth::user()->id,
                "degree"=>$request->degree,
                "name"=>$request->name,
                "subject"=>$subjects,
                "passing_year"=>$request->passing_year,
                'status'=>'0'
            ]);
        }
        else{
            return [['error'=>'Already Exist']];
        }
        $education_data=Education::where('user_id',Auth::user()->id)->get();
        return $education_data;       
    }

    public function finalEducation(){
        Education::where('user_id',Auth::user()->id)->update([
            'status'=>'1'
        ]);

        Specialization::where('user_id',Auth::user()->id)->update([
            'status'=>'1'
        ]);
    }

    public function getSubjects(){
        $subjects=
    }
}