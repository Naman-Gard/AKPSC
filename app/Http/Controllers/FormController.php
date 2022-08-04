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
use App\Models\LanguageDetails;
use Auth;

class FormController extends Controller
{

    public function index(){
        $education=Education::where('user_id',Auth::user()->id)->where('status','1')->get();
        $specialization=Specialization::where('user_id',Auth::user()->id)->where('status','1')->get();
        $experience=Experience::where('user_id',Auth::user()->id)->where('status','1')->get();
        $organization=Organization::where('user_id',Auth::user()->id)->where('status','1')->get();
        $isworking=IsWorking::where('user_id',Auth::user()->id)->where('status','1')->get();
        $preference=Preference::where('user_id',Auth::user()->id)->where('status','1')->get();
        $upload=Upload::where('user_id',Auth::user()->id)->where('status','1')->get();
        $step='';
        if(sizeOf($education) && sizeOf($specialization)){
            $step='experience';
        }
        else{
            $step='education';
            return view('step-form/index',compact('step'));
        }
        if(sizeOf($experience) && sizeOf($organization) && sizeOf($isworking)){
            $step='preference';
        }
        if(sizeOf($preference)){
            $step='upload';
        }
        if(sizeOf($upload)){
            return redirect()->route('preview');
        }
        return view('step-form/index',compact('step'));
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
            'status'=>'1'
        ]);
        
        return redirect()->route('preview');
    }

    public function preview(){
        $upload=Upload::where('user_id',Auth::user()->id)->where('status','1')->get();
        if(!sizeOf($upload)){
            return redirect()->route('fill-details');
        }
        else{
            return view('step-form/preview/index');
        }
    }

    public function getFormData(){
        $specialization_data=Specialization::where('user_id',Auth::user()->id)->get();
        $education_data=Education::where('user_id',Auth::user()->id)->get();
        $experience_data=Experience::where('user_id',Auth::user()->id)->get();
        $organization_data=Organization::where('user_id',Auth::user()->id)->get();
        $isworking_data=IsWorking::where('user_id',Auth::user()->id)->get();
        $language_data=LanguageDetails::where('user_id',Auth::user()->id)->get();
        $preference_data=Preference::where('user_id',Auth::user()->id)->get();
        $data=[
            'specialization'=>$specialization_data,
            'education'=>$education_data,
            'experience'=>$experience_data,
            'organization'=>$organization_data,
            'isworking'=>$isworking_data,
            'language'=>$language_data,
            'preference'=>$preference_data
        ];
        return $data;
    }
}