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
use App\Models\User;
use App\Models\LanguageDetails;
use App\Models\FinalStatus;
use App\Models\UserStatus;
use Auth;
use PDF;

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
        $exist=Upload::where('user_id',Auth::user()->id)->get();

        if(sizeOf($exist)){
            if($request->file('image') || $request->file('cv') || $request->file('signature')){

                $validator = Validator::make($request->all(),[
                    'image'=>'mimes:jpeg,jpg,png,svg,JPEG,JPG,PNG,SVG|max:500',
                    'signature'=>'mimes:jpeg,jpg,png,svg,JPEG,JPG,PNG,SVG|max:500',
                    'cv'=>'mimes:pdf|max:500'
                ]);

                if ($validator->fails()) {
                    return redirect()->route('fill-details')
                            ->withErrors($validator)
                            ->withInput();
                }

                if($request->file('image'))
                {
                    $image=$request->file('image');
                    $image_name=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('assets/uploads/images'),$image_name);
                }
                else{
                    $image_name=$exist[0]->image;
                }
                
                if($request->file('signature'))
                {
                    $image=$request->file('signature');
                    $signature_name=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('assets/uploads/signature'),$signature_name);
                }else{
                    $signature_name=$exist[0]->signature;
                }
                
                if($request->file('cv')){
                    $image=$request->file('cv');
                    $cv_name=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('assets/uploads/cv'),$cv_name);
                }
                else{
                    $cv_name=$exist[0]->cv;
                }
                

                Upload::where('user_id',Auth::user()->id)->update([
                    'image'=>$image_name,
                    'signature'=>$signature_name,
                    'cv'=>$cv_name,
                    'status'=>'1'
                ]);

            }
            else{
                Upload::where('user_id',Auth::user()->id)->update([
                    'status'=>1
                ]);
            }
            
        }
        else{
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
        }

        return redirect()->route('preview');
    }

    public function preview(){
        $upload=Upload::where('user_id',Auth::user()->id)->where('status','1')->get();
        if(!sizeOf($upload)){
            return redirect()->route('fill-details');
        }
        else{
            $finalStatus=FinalStatus::where('user_id',Auth::user()->id)->where('status','1')->get();
            $data=[];
            $data['personal_data']=User::where('id',Auth::user()->id)->first()->toArray();
            $data['education_data']['qualifications']=Education::where('user_id',Auth::user()->id)->get()->toArray();
            $data['education_data']['specialization']=Specialization::where('user_id',Auth::user()->id)->get()->toArray();
            $data['experience_data']['experience']=Experience::where('user_id',Auth::user()->id)->get()->toArray();
            $data['experience_data']['isworking']=IsWorking::where('user_id',Auth::user()->id)->first()->toArray();
            $data['experience_data']['organization']=Organization::where('user_id',Auth::user()->id)->get()->toArray();
            $data['preference_data']['preference']=Preference::where('user_id',Auth::user()->id)->first()->toArray();
            $data['preference_data']['language']=LanguageDetails::where('user_id',Auth::user()->id)->get()->toArray();
            $data['upload']=Upload::where('user_id',Auth::user()->id)->first()->toArray();
            if(!sizeof($finalStatus)){
                return view('step-form/preview/index',compact('data'));
            }
            else{
                return redirect()->route('profile');
            }
            
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
        $upload=Upload::where('user_id',Auth::user()->id)->get();
        $data=[
            'specialization'=>$specialization_data,
            'education'=>$education_data,
            'experience'=>$experience_data,
            'organization'=>$organization_data,
            'isworking'=>$isworking_data,
            'language'=>$language_data,
            'preference'=>$preference_data,
            'upload'=>$upload
        ];
        return $data;
    }

    public function editForm(){
        Education::where('user_id',Auth::user()->id)->update([
            'status'=>'0'
        ]);
        Experience::where('user_id',Auth::user()->id)->update([
            'status'=>'0'
        ]);
        Preference::where('user_id',Auth::user()->id)->update([
            'status'=>'0'
        ]);
        Organization::where('user_id',Auth::user()->id)->update([
            'status'=>'0'
        ]);
        Upload::where('user_id',Auth::user()->id)->update([
            'status'=>'0'
        ]);
    }

    public function finalSubmit(){
        $exist=FinalStatus::where('user_id',Auth::user()->id)->get();
        if(!sizeOf($exist)){
            $unique=uniquecodeGenerator();
            UserStatus::create([
                'user_id'=>Auth::user()->id,
                'register_id'=>$unique,
                'empanelled'=>0,
                'blacklisted'=>0,
                'appointed'=>0,
            ]);
            FinalStatus::create([
                'user_id'=>Auth::user()->id,
                'status'=>1
            ]);
        }
    }

    public function finalView(){
        $exist=FinalStatus::where('user_id',Auth::user()->id)->where('status','1')->get();
        if(!sizeOf($exist)){
            return redirect()->route('preview');
        }
        else{
            $data=[];
            $data['personal_data']=User::where('id',Auth::user()->id)->first()->toArray();
            $data['education_data']['qualifications']=Education::where('user_id',Auth::user()->id)->get()->toArray();
            $data['education_data']['specialization']=Specialization::where('user_id',Auth::user()->id)->get()->toArray();
            $data['experience_data']['experience']=Experience::where('user_id',Auth::user()->id)->get()->toArray();
            $data['experience_data']['isworking']=IsWorking::where('user_id',Auth::user()->id)->first()->toArray();
            $data['experience_data']['organization']=Organization::where('user_id',Auth::user()->id)->get()->toArray();
            $data['preference_data']['preference']=Preference::where('user_id',Auth::user()->id)->first()->toArray();
            $data['preference_data']['language']=LanguageDetails::where('user_id',Auth::user()->id)->get()->toArray();
            $data['upload']=Upload::where('user_id',Auth::user()->id)->first()->toArray();
            return view('step-form/success/index',compact('data'));
        }
    }

    public function generatePDF(){
        $data=[];
        $data['personal_data']=User::where('id',Auth::user()->id)->first()->toArray();
        $data['education_data']['qualifications']=Education::where('user_id',Auth::user()->id)->get()->toArray();
        $data['education_data']['specialization']=Specialization::where('user_id',Auth::user()->id)->get()->toArray();
        $data['experience_data']['experience']=Experience::where('user_id',Auth::user()->id)->get()->toArray();
        $data['experience_data']['isworking']=IsWorking::where('user_id',Auth::user()->id)->first()->toArray();
        $data['experience_data']['organization']=Organization::where('user_id',Auth::user()->id)->get()->toArray();
        $data['preference_data']['preference']=Preference::where('user_id',Auth::user()->id)->first()->toArray();
        $data['preference_data']['language']=LanguageDetails::where('user_id',Auth::user()->id)->get()->toArray();
        $data['upload']=Upload::where('user_id',Auth::user()->id)->first()->toArray();
        $finalData=[
            'data'=>$data
        ];
        $pdf = PDF::loadView('step-form/pdf/index', compact('data'))->setOptions(['javascript-delay' => 500,'page-size'=>'a4','chroot'  => public_path('assets/')]);
        
        return $pdf->download('preview.pdf');
    }
}