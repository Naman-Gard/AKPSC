<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FinalStatus;
use Auth;
use App\Models\Experience;
use App\Models\Preference;
use App\Models\Education;
use App\Models\Specialization;
use App\Models\Organization;
use App\Models\IsWorking;
use App\Models\Upload;
use App\Models\LanguageDetails;

class ProfileController extends Controller
{
    public function index(){
        $education=Education::where('user_id',Auth::user()->id)->where('status','1')->get();
        $specialization=Specialization::where('user_id',Auth::user()->id)->where('status','1')->get();
        $experience=Experience::where('user_id',Auth::user()->id)->where('status','1')->get();
        $organization=Organization::where('user_id',Auth::user()->id)->where('status','1')->get();
        $isworking=IsWorking::where('user_id',Auth::user()->id)->where('status','1')->get();
        $preference=Preference::where('user_id',Auth::user()->id)->where('status','1')->get();
        $upload=Upload::where('user_id',Auth::user()->id)->where('status','1')->get();
        $language=LanguageDetails::where('user_id',Auth::user()->id)->where('status','1')->get();
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
        $exist=FinalStatus::where('user_id',Auth::user()->id)->where('status','1')->get();
        if(!sizeOf($exist) || $step!==''){
            return redirect()->route('preview');
        }
        else{
            $user=User::join('final_statuses','final_statuses.user_id','=','users.id')
            ->join('uploads','uploads.user_id','=','users.id')
            ->where('users.id',Auth::user()->id)
            ->first();
            return view('profile.index',compact('user'));
        }
    }
}
