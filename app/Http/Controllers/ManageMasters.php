<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ManageMasters extends Controller
{
    public function getQualification(){
        $qualifications=DB::table('qualification_master')->get();
        $degreeTypes=DB::table('qualification_master')->select('qual_name')->distinct()->get();
        return view('admin.masters.qualification',compact('qualifications','degreeTypes'));
    }

    public function addDegreeType(Request $request){
        $degreeTypes=explode('||',$request->degree_type);
        $existedDegrees=[];
        foreach($degreeTypes as $degree){
            $temp=trim($degree," ");
            $isExist=DB::table('qualification_master')->where('qual_name','iLike',$temp)->first();
            if(!$isExist){
                DB::table('qualification_master')->insert([
                    'qual_name'=>$temp,
                    'qual_deg'=>'',
                    'qual_sub'=>''
                ]);
            }
            else{
                array_push($existedDegrees,$temp);
            }
        }
        if(sizeOf($existedDegrees)){
            return redirect()->route('qualification')->with('error',implode(',',$existedDegrees).' already exist');
        }
        return redirect()->route('qualification')->with('success','Degree Types added successfully');
    }

    public function addDegreeName(Request $request){
        $degreeNames=explode('||',$request->degree_name);
        $existedDegrees=[];
        foreach($degreeNames as $degree){
            $temp=trim($degree," ");
            $isExist=DB::table('qualification_master')->where('qual_name',$request->degree_type)
                ->where('qual_deg','ilike',$temp)
                ->first();
            if(!$isExist){
                $emptyExist=DB::table('qualification_master')->where('qual_name',$request->degree_type)
                ->where('qual_deg','')
                ->first();
                if($emptyExist){
                    DB::table('qualification_master')->where('id',$emptyExist->id)->update([
                        'qual_deg'=>$temp
                    ]);
                }
                else{
                    DB::table('qualification_master')->insert([
                        'qual_name'=>$request->degree_type,
                        'qual_deg'=>$temp
                    ]);
                }
            }
            else{
                array_push($existedDegrees,$temp);
            }
        }
        if(sizeOf($existedDegrees)){
            return redirect()->route('qualification')->with('error',implode(',',$existedDegrees).' already exist');
        }
        return redirect()->route('qualification')->with('success','Degree Names added successfully');
    }

    public function addSubject(Request $request){
        // dd($request);
        $subjects=explode('||',$request->subject);
        $existedDegrees=[];
        foreach($subjects as $subject){
            $temp=trim($subject," ");
            $isExist=DB::table('qualification_master')->where('qual_name',$request->degree_type)
                ->where('qual_deg','ilike',$request->degree_name)
                ->where('qual_sub','ilike',$temp)
                ->first();
            if(!$isExist){
                $emptyExist=DB::table('qualification_master')->where('qual_name',$request->degree_type)
                ->where('qual_deg','ilike',$request->degree_name)
                ->where('qual_sub','')
                ->first();
                if($emptyExist){
                    DB::table('qualification_master')->where('id',$emptyExist->id)->update([
                        'qual_sub'=>$temp
                    ]);
                }
                else{
                    DB::table('qualification_master')->insert([
                        'qual_name'=>$request->degree_type,
                        'qual_deg'=>$request->degree_name,
                        'qual_sub'=>$temp
                    ]);
                }
            }
            else{
                array_push($existedDegrees,$temp);
            }
        }
        if(sizeOf($existedDegrees)){
            return redirect()->route('qualification')->with('error',implode(',',$existedDegrees).' already exist');
        }
        return redirect()->route('qualification')->with('success','Subjects added successfully');
    }

    public function deleteQualification($id){
        $id=base64_decode($id);
        DB::table('qualification_master')->where('id',$id)->delete();
        return redirect()->route('qualification')->with('success','Qualification deleted successfully');
    }

    public function getQualificationsubject(){
        $degreeTypes=DB::table('qualification_master')->select('qual_deg','qual_name')->distinct()->get()->groupBy('qual_name');
        return $degreeTypes;
    }
}
