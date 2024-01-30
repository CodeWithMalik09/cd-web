<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\Tutor;
use App\Models\OperationArea;
use App\traits\SendSMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class TutorRegistrationController extends Controller
{
    use SendSMS;

    public function register(Request $request)
    {
        $check_email = Tutor::where('email', $request->input('email'))->get();
        $check_phone = Tutor::where('phone', $request->input('phone'))->get();
        if ($check_email->count() >= 1) {
            return redirect()->back()->with('message', 'Email Id already exists.');
        } else if ($check_phone->count() >= 1) {
            return redirect()->back()->with('message', 'Phone Number already exists.');
        } else {
            $tutor = Tutor::create(
                [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'password' => md5($request->input('password')),
                ]
            );

            $otp = rand(100000, 999999);
            Otp::create(
                [
                    'role' => 'tutor',
                    'role_id' => $tutor->id,
                    'otp' => $otp,
                ]
            );
            
            $this->SendOtpToNumber($request->phone, $otp);
            Session::put('verification_details', array('type' => 'tutor', 'phone' => Crypt::encrypt($request->input('phone'))));

            return view('verification');
        }
    }

    public function adddetails(Request $request)
    {

        $data = [
            'about' => $request->input('about'),
            'course' => json_encode($request->input('courses')),
            'city' => $request->input('city'),
            'gender' => $request->input('gender'),
            'alternate_phone' => $request->input('alternate_phone'),
            'present_address' => $request->input('present_address'),
            'qualification_details' => $request->input('qualification_details'),
            'fee_per_month' => $request->input('fee_per_month'),
            'fee_per_hour' => $request->input('fee_per_hour'),
            'board' => $request->input('board'),
            'specialization' => $request->input('specialization'),
            'subjects' => $request->input('subjects'),
            'free_demo_class' => $request->input('free_demo_class'),
        ];

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->getClientOriginalName();
            $path = $thumbnail->storeAs('public/tutorthumbnail', $thumbnail_name);
            $thumb_ext = explode('/', $path);
            $data['thumbnail']  = $thumb_ext[1] . '/' . $thumb_ext[2];
        }

        if ($request->hasFile('aadhaar_front')) {
            $aadhaarFront = $request->file('aadhaar_front');
            $aadhaar_front_name = $aadhaarFront->getClientOriginalName();
            $path = $aadhaarFront->storeAs('public/tutor_aadhaar_front', $aadhaar_front_name);
            $thumb_ext = explode('/', $path);
            $data['aadhaar_front']  = $thumb_ext[1] . '/' . $thumb_ext[2];
        }

        if ($request->hasFile('aadhaar_back')) {
            $aadhaarBack = $request->file('aadhaar_back');
            $aadhaar_back_name = $aadhaarBack->getClientOriginalName();
            $path = $aadhaarBack->storeAs('public/tutor_aadhaar_back', $aadhaar_back_name);
            $thumb_ext = explode('/', $path);
            $data['aadhaar_back']  = $thumb_ext[1] . '/' . $thumb_ext[2];
        }

        $tutor = Tutor::where('phone', Crypt::decrypt(session('verification_details')['phone']))->first();

        $remove_aps = str_replace("'", "", $tutor->name);
        $remove_amp = str_replace("&", "", $remove_aps);
        $remove_slash = str_replace("/", "-", $remove_amp);
        $slug = implode('-', explode(' ', strtolower($remove_slash)));
        $cities = OperationArea::whereIn('id', [$request->input('city')])->pluck('name');
        $slug = $slug . '-' . strtolower($cities[0]);

        // if (Tutor::where('slug', $slug)->count() > 0) {
        //     return redirect()->back()->with('message', 'Tutor already exists');
        // }

        $data['slug'] = $slug;

        Tutor::where('phone', Crypt::decrypt(session('verification_details')['phone']))->update(
            $data
        );

        return view('tutorregistration.confirm');
    }

    public function resendOTP()
    {
        $tutor_id = Tutor::where('phone',Crypt::decrypt(session('verification_details')['phone']))->get()->first()->id;
        $otp = rand(100000, 999999);
        Otp::create(
                [
                    'role' => 'tutor',
                    'role_id' => $tutor_id,
                    'otp' => $otp,
                ]
            );
        $this->SendOtpToNumber(Crypt::decrypt(session('verification_details')['phone']), $otp);
        return redirect('verification')->with('message','OTP sent! Kindly enter otp sent on your phone');
    }
}
