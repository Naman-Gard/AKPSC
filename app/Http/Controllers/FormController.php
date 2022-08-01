<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Experience;
use App\Models\Preference;
use App\Models\Education;
use Auth;

class FormController extends Controller
{

    public function index(){
        $education=Education::where('user_id',Auth::user()->id)->where('status','1')->get();
        $experience=Experience::where('user_id',Auth::user()->id)->get();
        $preference=Preference::where('user_id',Auth::user()->id)->get();
        $education_details=Education::where('user_id',Auth::user()->id)->get();
        $step='';
        if(sizeOf($education)){
            $step='experience';
        }
        else{
            $step='education';
            return view('step-form/index',compact('step','education_details','experience','preference'));
        }
        if(sizeOf($experience)){
            $step='preference';
        }
        if(sizeOf($preference)){
            $step='upload';
        }
        return view('step-form/index',compact('step','education_details','experience','preference'));
    }

    public function submit(Request $request){
        dd($request);
        $validator = Validator::make($request->all(),[
            'image'=>'required|mimes:jpeg,jpg,png,svg,JPEG,JPG,PNG,SVG|max:500',
            'signature'=>'required|mimes:jpeg,jpg,png,svg,JPEG,JPG,PNG,SVG|max:500',
            'cv'=>'required|mimes:pdf|max:500'
        ]);

        if ($validator->fails()) {
            return redirect()->route('fill-details')
                    ->withErrors($validator)
                    ->withInput();
        }

        $image=$request->file('image');
        $image_name=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('assets/uploads/images'),$image_name);

        $image=$request->file('signature');
        $signature_name=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('assets/uploads/signature'),$signature_name);

        $image=$request->file('cv');
        $cv_name=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('assets/uploads/cv'),$cv_name);

        Upload::create([
            'user_id'=>Auth::user()->id,
            'image'=>$image_name,
            'signature'=>$signature_name,
            'cv'=>$cv_name,
        ]);
        
        
    }

    public function education(Request $request){
        $exist=Education::where('user_id',Auth::user()->id)->where('specialization',$request->specialization)->get();
        if(!sizeOf($exist)){
            Education::create([
                'user_id'=>Auth::user()->id,
                "specialization"=>$request->specialization,
                "super_specialization"=>$request->super_specialization,
                "type"=>$request->degree,
                "name"=>$request->name,
                "subject"=>$request->subject,
                "passing_year"=>$request->passing_year,
                'status'=>0
            ]);
        }
        else{
            Education::where('id',$exist[0]->id)->update([
                'super_specialization'=>$request->super_specialization.','.$exist[0]->super_specialization
            ]);
        }
        // dd($request);
        
        return ['status'=>'success'];
    }

    public function experience(Request $request){
        $exist=Experience::where('user_id',Auth::user()->id)->get();
        if(!sizeOf($exist)){
            Experience::create([
                'user_id'=>Auth::user()->id,
                "isworking"=>$request->isworking,
                "designation"=>$request->designation,
                "serving"=>$request->serving,
                "type"=>$request->type,
                "year"=>$request->year,
                "specify"=>$request->specify,
                "org_type"=>$request->org_type,
                "org_name"=>$request->org_name,
                "org_year"=>$request->org_year
            ]);
        }
        else{
            Experience::where('user_id',Auth::user()->id)->update([
                "isworking"=>$request->isworking,
                "designation"=>$request->designation,
                "serving"=>$request->serving,
                "type"=>$request->type,
                "year"=>$request->year,
                "specify"=>$request->specify,
                "org_type"=>$request->org_type,
                "org_name"=>$request->org_name,
                "org_year"=>$request->org_year
            ]);
        }
        return ['status'=>'success'];
    }
    
    public function preference(Request $request){
        $exist=Preference::where('user_id',Auth::user()->id)->get();
        if(!sizeOf($exist)){
            Preference::create([
                'user_id'=>Auth::user()->id,
                "paper_setter"=>$request->paper_setter,
                "interview"=>$request->interview,
                "line_1"=>$request->line_1,
                "line_2"=>$request->line_2,
                "pincode"=>$request->pin_code,
                "brief"=>$request->brief,
                "enquiry"=>$request->enquiry,
            ]);
        }
        else{
            Preference::where('user_id',Auth::user()->id)->update([
                "paper_setter"=>$request->paper_setter,
                "interview"=>$request->interview,
                "line_1"=>$request->line_1,
                "line_2"=>$request->line_2,
                "pincode"=>$request->pin_code,
                "brief"=>$request->brief,
                "enquiry"=>$request->enquiry,
            ]);
        }
        return ['status'=>'success'];
    }

    public function finalEducation(){
        Education::where('user_id',Auth::user()->id)->update([
            'status'=>1
        ]);
    }

    public function getExperienceData(){
        $experience=Experience::where('user_id',Auth::user()->id)->get();
        return $experience;
    }

    public function getPreferenceData(){
        $preference=Preference::where('user_id',Auth::user()->id)->get();
        return $preference;
    }

    public function deleteEducation($id){
        $id=decode5t($id);
        Education::where('id',$id)->delete();
        return ['status'=>'success'];
    }
}