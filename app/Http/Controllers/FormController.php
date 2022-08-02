<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Experience;
use App\Models\Preference;
use App\Models\Education;
use App\Models\Specialization;
use App\Models\Organization;
use App\Models\IsWorking;
use App\Models\Upload;
use Auth;

class FormController extends Controller
{

    public function index(){
        $education=Education::where('user_id',Auth::user()->id)->where('status','1')->get();
        $specialization=Specialization::where('user_id',Auth::user()->id)->where('status','1')->get();
        $experience=Experience::where('user_id',Auth::user()->id)->where('status','1')->get();
        $organization=Organization::where('user_id',Auth::user()->id)->where('status','1')->get();
        $isworking=IsWorking::where('user_id',Auth::user()->id)->where('status','1')->get();
        $preference=Preference::where('user_id',Auth::user()->id)->get();
        $education_details=Education::where('user_id',Auth::user()->id)->get();
        $upload=Upload::where('user_id',Auth::user()->id)->get();
        $step='';
        if(sizeOf($education) && sizeOf($specialization)){
            $step='experience';
        }
        else{
            $step='education';
            return view('step-form/index',compact('step','preference'));
        }
        if(sizeOf($experience) && sizeOf($organization) && sizeOf($isworking)){
            $step='preference';
        }
        if(sizeOf($preference)){
            $step='upload';
        }
        if(sizeOf($upload)){
            return redirect()->route('success');
        }
        return view('step-form/index',compact('step','preference'));
    }

    public function submit(Request $request){
        // dd($request);
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
        
        return redirect()->route('success');
    }
    
    public function preference(Request $request){
        $exist=Preference::where('user_id',Auth::user()->id)->get();
        if(!sizeOf($exist)){
            Preference::create([
                'user_id'=>Auth::user()->id,
                "paper_setter"=>$request->paper_setter,
                "interview"=>$request->interview,
                'language'=>$request->language,
                'proficiency'=>$request->proficiency,
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
                'language'=>$request->language,
                'proficiency'=>$request->proficiency,
                "line_1"=>$request->line_1,
                "line_2"=>$request->line_2,
                "pincode"=>$request->pin_code,
                "brief"=>$request->brief,
                "enquiry"=>$request->enquiry,
            ]);
        }
        return ['status'=>'success'];
    }

    public function getPreferenceData(){
        $preference=Preference::where('user_id',Auth::user()->id)->get();
        return $preference;
    }

    public function success(){
        return view('step-form/success/success');
    }

    public function getFormData(){
        $specialization_data=Specialization::where('user_id',Auth::user()->id)->get();
        $education_data=Education::where('user_id',Auth::user()->id)->get();
        $experience_data=Experience::where('user_id',Auth::user()->id)->get();
        $organization_data=Organization::where('user_id',Auth::user()->id)->get();
        $isworking_data=IsWorking::where('user_id',Auth::user()->id)->get();
        $data=[
            'specialization'=>$specialization_data,
            'education'=>$education_data,
            'experience'=>$experience_data,
            'organization'=>$organization_data,
            'isworking'=>$isworking_data
        ];
        return $data;
    }
}