<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coaching;
use App\Models\NewCoaching;
use App\Models\Course;
use App\Models\OperationArea;
use App\Models\Locality;
use App\Models\Otp;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class VerificationController extends Controller
{
    public function verifyscreen(){
        return view('verification');
    }

    public function verify(Request $request){

        if($request->input('type') == "coaching"){
            $coaching_id = NewCoaching::where('phone',Crypt::decrypt($request->input('phone')))->get()->first()->id;
            $verify = Otp::where([['role','=',$request->input('type')],['role_id','=',$coaching_id],['otp','=',$request->input('otp')]])->get();
            if($verify->count() == 1){
                $courses = Course::all();
                $categories = Category::all();
                $cities = OperationArea::all();
                $localities=Locality::all();
                $data = array(
                    'courses'=>$courses,
                    'categories'=>$categories,
                    'cities'=>$cities,
                    'localities'=>$localities,
                );
                return view('coachingregistration.steptwo',$data);
            }else{
                return redirect()->back()->with('message','Invalid otp! Kindly enter correct otp sent on your email or phone');
            }
        }

        if($request->input('type') == "tutor"){
            $tutor_id = Tutor::where('email',Crypt::decrypt($request->input('email')))->get()->first()->id;
            $verify = Otp::where([['role','=',$request->input('type')],['role_id','=',$tutor_id],['otp','=',$request->input('otp')]])->get();
            if($verify->count() == 1){
                $courses = Course::all();
                $categories = Category::all();
                $cities = OperationArea::all();
                $data = array(
                    'courses'=>$courses,
                    'categories'=>$categories,
                    'cities'=>$cities,
                );
                return view('tutorregistration.steptwo',$data);
            }else{
                return redirect()->back()->with('message','Invalid otp! Kindly enter correct otp sent on your email or phone');
            }
        }

        if($request->input('type') == "student"){
            return view('coachingregistrationsteptwo');
        }

    }
}
