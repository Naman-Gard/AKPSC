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
use GuzzleHttp\Client;
use Auth;
use DB;
use PDF;

class FormController extends Controller
{

    public function checkStep(){
        $education=Education::where('user_id',Auth::user()->id)->where('status','1')->get();
        $specialization=Specialization::where('user_id',Auth::user()->id)->where('status','1')->get();
        $experience=Experience::where('user_id',Auth::user()->id)->where('status','1')->get();
        $organization=Organization::where('user_id',Auth::user()->id)->where('status','1')->get();
        $isworking=IsWorking::where('user_id',Auth::user()->id)->where('status','1')->get();
        $preference=Preference::where('user_id',Auth::user()->id)->where('status','1')->get();
        $language=LanguageDetails::where('user_id',Auth::user()->id)->where('status','1')->get();
        $upload=Upload::where('user_id',Auth::user()->id)->where('status','1')->get();
        $step='';

        if(!sizeOf($upload)){
            $step='upload';
        }

        if(!sizeOf($preference) || !sizeOf($language)){
            $step='preference';
        }

        if(!sizeOf($experience) || !sizeOf($isworking)){
            $step='experience';
        }
        else{
            if($isworking[0]->isprior==='Yes'){
                if(!sizeOf($organization)){
                    $step='experience';
                }
            }
        }

        if(!sizeOf($education) || !sizeOf($specialization)){
            $step='education';
        }

        return $step;
    }

    public function index(){

        $step=$this->checkStep();
        
        if($step==''){
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
        $step=$this->checkStep();
        if($step!=''){
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
        $exist=FinalStatus::where('user_id',Auth::user()->id)->where('status',1)->get();
        if(!sizeOf($exist)){

            FinalStatus::where('user_id',Auth::user()->id)->update([
                'status'=>1
            ]);

            // $message='Dear Applicant,<br>';
            // $message.='your application has been submitted successfully.<br>';
            // $message.='Regards,<br>';
            // $message.='UKPSC';

            // $client = new Client();
            // $res = $client->request('POST', 'http://sms.holymarkindia.in/API/WebSMS/Http/v1.0a/index.php', [
            //     'form_params' => [
            //         "username"=>env('NY_USERNAME'),
            //         "password"=>env('NY_PASSWORD'),
            //         "sender"=>env('NY_SENDER'),
            //         "pe_id"=>env('NY_PE_ID'),
            //         "reqid"=>env('NY_REQ_ID'),
            //         "template_id"=>env('APPC_TEMPLATE_ID'),
            //         "format"=>"json",
            //         'message'=>$message,
            //         'to'=>base64_decode($mobile)
            //     ]
            // ]);

        }
    }

    public function finalView(){
        $exist=FinalStatus::where('user_id',Auth::user()->id)->where('status','1')->get();
        $step=$this->checkStep();
        if(!sizeOf($exist)){
            return redirect()->route('preview');
        }
        else{
            if($step!=''){
                return redirect()->route('fill-details');
            }
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
        $register=FinalStatus::where('user_id',Auth::user()->id)->first();
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
        
        return $pdf->download($register->register_id.'.pdf');
    }

    public function getStates(){
        $states=DB::table('district_masters')->orderBy('state_name')->get()->groupBy('state_name');
        return $states;
    }
}