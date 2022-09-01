<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Models\Education;
use Auth;
use DB;

class EducationController extends Controller
{
    public function addSpecialization(Request $request){
        $exist=Specialization::where('user_id',Auth::user()->id)->where('specialization',$request->specialization)->where('subject',$request->specialization_subject)->get();
        $is_exist_subject=DB::table('subject_master')->where('subject',$request->specialization_subject)->get();
        $is_exist_specialization=DB::table('subject_master')->where('subject',$request->specialization_subject)->where('specialization',$request->specialization)->first();
        $is_exist_super_specialization=DB::table('subject_master')->where('subject',$request->specialization_subject)->where('specialization',$request->super_specialization)->first();
        if(sizeOf($is_exist_subject)){
            if($request->specialization!==$request->super_specialization){
                if(!$is_exist_specialization && $request->specialization!=='Not Applicable'){
                    DB::table('subject_master')->insert([
                        'subject'=>$request->specialization_subject,
                        'specialization'=>$request->specialization
                    ]);
                }
                if(!$is_exist_super_specialization && $request->super_specialization!=='Not Applicable'){
                    DB::table('subject_master')->insert([
                        'subject'=>$request->specialization_subject,
                        'specialization'=>$request->super_specialization
                    ]);
                }
            }
            else{
                if(!$is_exist_specialization && $request->specialization!=='Not Applicable'){
                    DB::table('subject_master')->insert([
                        'subject'=>$request->specialization_subject,
                        'specialization'=>$request->specialization
                    ]);
                }
            }
        }
        else{
            if($request->specialization!==$request->super_specialization){
                if(!$is_exist_specialization && $request->specialization!=='Not Applicable'){
                    DB::table('subject_master')->insert([
                        'subject'=>$request->specialization_subject,
                        'specialization'=>$request->specialization
                    ]);
                }
                if(!$is_exist_super_specialization && $request->super_specialization!=='Not Applicable'){
                    DB::table('subject_master')->insert([
                        'subject'=>$request->specialization_subject,
                        'specialization'=>$request->super_specialization
                    ]);
                }
            }
            else{
                if(!$is_exist_specialization && $request->specialization!=='Not Applicable'){
                    DB::table('subject_master')->insert([
                        'subject'=>$request->specialization_subject,
                        'specialization'=>$request->specialization
                    ]);
                }
            }
        }
        // if($request->specialization!==$request->specialization_subject){

        //     if($request->super_specialization!==$request->specialization_subject){
        //         if($request->super_specialization!==$request->specialization){
        //             $new_subject=DB::table('subject_master')->where('subject_list',$request->super_specialization)->first();
        //             if(!$new_subject){
        //                 DB::table('subject_master')->insert([
        //                     'subject_list'=>$request->super_specialization
        //                 ]);
        //             }
        //             $new_subject=DB::table('subject_master')->where('subject_list',$request->specialization_subject)->first();
        //             if(!$new_subject){
        //                 DB::table('subject_master')->insert([
        //                     'subject_list'=>$request->specialization_subject
        //                 ]);
        //             }
        //         }
        //     }
        //     else{
        //         $new_subject=DB::table('subject_master')->where('subject_list',$request->specialization_subject)->first();
        //         if(!$new_subject){
        //             DB::table('subject_master')->insert([
        //                 'subject_list'=>$request->specialization_subject
        //             ]);
        //         }
        //     }
        //     $new_subject=DB::table('subject_master')->where('subject_list',$request->specialization)->first();
        //     if(!$new_subject){
        //         DB::table('subject_master')->insert([
        //             'subject_list'=>$request->specialization
        //         ]);
        //     }
        // }
        // else{
        //     if($request->super_specialization!==$request->specialization_subject){
        //         $new_subject=DB::table('subject_master')->where('subject_list',$request->specialization_subject)->first();
        //         if(!$new_subject){
        //             DB::table('subject_master')->insert([
        //                 'subject_list'=>$request->specialization_subject
        //             ]);
        //         }

        //         $new_subject=DB::table('subject_master')->where('subject_list',$request->super_specialization)->first();
        //         if(!$new_subject){
        //             DB::table('subject_master')->insert([
        //                 'subject_list'=>$request->super_specialization
        //             ]);
        //         }
        //     }
        //     else{
        //         $new_subject=DB::table('subject_master')->where('subject_list',$request->specialization_subject)->first();
        //         if(!$new_subject){
        //             DB::table('subject_master')->insert([
        //                 'subject_list'=>$request->specialization_subject
        //             ]);
        //         }
        //     }

        // }
        if(!sizeOf($exist)){
            Specialization::create([
                'user_id'=>Auth::user()->id,
                "subject"=>$request->specialization_subject,
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
        $exist=Education::where('user_id',Auth::user()->id)->where('passing_year',$request->passing_year)->get();
        $exist1=Education::where('user_id',Auth::user()->id)->where("name",$request->name)->get();
        if(!sizeOf($exist) && !sizeOf($exist1)){
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
        $subjects=DB::table('subject_master')->orderBy('subject')->get()->groupBy('subject');
        return $subjects;
    }

    public function getQualifications(){
        $qualification=DB::table('qualification_master')->get()->groupBy(['qual_name','qual_deg']);
        return $qualification;
    }
}