<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationOtp;
use App\Models\Wishlist;
use App\traits\SendSMS;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    use SendSMS;

    public function sendOtp(Request $request)
    {

        $check_user = User::where('phone', $request->phone)->get();

        if ($check_user->count() > 0) {
            if ($request->type == "login") {
                $otp = rand(1000, 9999);
                $otp_res = $this->SendOtpToNumber($request->phone, $otp);
                if ($otp_res->status == "success") {
                    VerificationOtp::create(
                        [
                            'phone' => $request->phone,
                            'otp' => $otp,
                            'type' => 'cdlogin'
                        ]
                    );
                    return response()->json(['message' => 'OTP sent successfully.', 'status' => 'success'], 200);
                } else {
                    return response()->json(['message' => 'Oops! something went wrong.', 'status' => 'fail'], 500);
                }
            } else {
                return response()->json(['message' => 'Phone number already exists.', 'status' => 'fail'], 500);
            }
        } else {
            if ($request->type == "register") {
                $otp = rand(1000, 9999);
                $otp_res = $this->SendOtpToNumber($request->phone, $otp);
                if ($otp_res->status == "success") {
                    VerificationOtp::create(
                        [
                            'phone' => $request->phone,
                            'otp' => $otp,
                            'type' => 'cdlogin'
                        ]
                    );
                    return response()->json(['message' => 'OTP sent successfully.', 'status' => 'success'], 200);
                } else {
                    return response()->json(['message' => 'Oops! something went wrong.', 'status' => 'fail'], 500);
                }
            } else {
                return response()->json(['message' => "Phone number is not registered. <a href='" . url("/login?register=true") . "' style='color:blue;'>Click here to register.</a>", 'status' => 'fail'], 200);
            }
        }
    }

    public function login()
    {
         $courses=Course::all();
        if (isset($_SERVER['HTTP_REFERER'])) {
            Session::put('redirected_from', $_SERVER['HTTP_REFERER']);
        }
        return view('studentlogin',['courses'=>$courses]);
    }

    public function validateLogin(Request $request)
    {
        if ($request->has('password')) {
            $user = User::where('phone', $request->input('phone'))->get();
            if($user->count() > 0){
                $check =  Hash::check($request->password, $user->first()->password);
                if (!$check ) {
                    return redirect()->back()->with('message', 'Invalid Credentials!!!');
                }
            }
        } else {
            $check_otp = VerificationOtp::where('phone', $request->phone)->get();
            if ($check_otp->count() == 0) {
                return redirect()->back()->with('message', 'Invalid OTP');
            } else if ($check_otp->last()->otp != $request->otp) {
                return redirect()->back()->with(['message' => 'Invalid OTP', 'is_otp_field_visible' => TRUE]);
            }
            $user = User::where('phone', $request->phone)->get();
        }
        if ($user->count() == 1) {
            Session::put('user', $user[0]);
            Auth::login($user[0]);
            setcookie('showpopup', 'no');
             $student_phone = $request->input('phone');
            $userz = User::where('phone', $student_phone)->first();
            if ($userz) {
             $userz->update(['latest_login_time' => now()]);
           }
            if (session('redirected_from') && !str_contains(session('redirected_from'),'/login')) {
                return redirect(session('redirected_from'));
            } else {
                return redirect('/user/profile');
            }
        } else {
            return redirect()->back()->with('message', 'Invalid Credentials!!!');
        }
    }

    public function verifyNumber(Request $request)
    {
        $check_email = User::where('email', $request->input('email'))->get();
        $check_phone = User::where('phone', $request->input('phone'))->get();

        if ($check_email->count() >= 1) {
            return redirect()->back()->with('email_error', 'Email already exists!!!');
        } else if ($check_phone->count() >= 1) {
            return redirect()->back()->with('phone_error', 'Phone number already exists!!!');
        }
        else
        {
            $otp = rand(1000, 9999);
            $otp_res = $this->SendOtpToNumber($request->phone, $otp);
            if ($otp_res->status == "success") {
                VerificationOtp::create(
                    [
                        'phone' => $request->phone,
                        'otp' => $otp,
                        'type' => 'cdlogin'
                    ]
                );
                Session::put('student_register_details', array('type' => 'register', 'name' => $request->input('name'), 'phone' => Crypt::encrypt($request->input('phone')), 'email' => $request->input('email'), 'password' => $request->input('password')));
                return redirect('phoneverification'); 
            } else {
                return redirect()->back()->with('message', 'Oops! something went wrong. Try Again !!');
            }
        }
    }

    public function verifyScreen(){
        return view('studentPhoneVerification'); 
    }

    public function registration(Request $request)
    {
        $check_otp = VerificationOtp::where('phone', Crypt::decrypt($request->phone))->get();
        if ($check_otp->count() == 0) {
            return redirect()->back()->with('message', 'Invalid OTP');
        } else if ($check_otp->last()->otp != $request->otp) {
            return redirect()->back()->with('message', 'Invalid OTP');
        }
        else
        {
            $createduser = User::create(
                    [
                        'name'     => $request->input('name'),
                        'email'    => $request->input('email'),
                        'phone'    => Crypt::decrypt($request->input('phone')),
                        'password' => Hash::make($request->input('otp')),
                        'username' => strtolower(explode(' ', $request->name)[0]) . substr($request->phone, 0, 5)
                    ]
            );
            Session::put('user', $createduser);
            Auth::login($createduser);
            Session::forget('student_register_details');
        }
        return redirect('/');
    }

    public function addToWishlist(Request $request)
    {
        $check = Wishlist::where([['type', '=', $request->input('type')], ['user_id', '=', session('user')->id], ['wish_id', '=', Crypt::decrypt($request->input('wish_id'))]])->get();
        if ($check->count() >= 1) {
            Wishlist::where([['type', '=', $request->input('type')], ['user_id', '=', session('user')->id], ['wish_id', '=', Crypt::decrypt($request->input('wish_id'))]])->delete();
            return response()->json(['message' => 'already in your wishlist'], 200);
        } else {
            Wishlist::create(
                [
                    'user_id' => session('user')->id,
                    'wish_id' => Crypt::decrypt($request->input('wish_id')),
                    'type' => $request->input('type'),
                ]
            );
            return response()->json(['message' => 'success'], 200);
        }
    }



    public function update(Request $request)
    {
        $update_data = [
            'name' => $request->input('name'),
        ];

        if ($request->input('password')) {
            $update_data['password'] = md5($request->input('password'));
        }

        User::find(session('user')->id)->update(
            $update_data
        );

        Session::put('user', User::find(session('user')->id));

        return redirect()->back()->with('message', 'Profile updated successfully');
    }

    public function resendOTP()
    {
        $otp = rand(1000, 9999);
            $otp_res = $this->SendOtpToNumber(Crypt::decrypt(session('student_register_details')['phone']), $otp);
            if ($otp_res->status == "success") {
                VerificationOtp::create(
                    [
                        'phone' => Crypt::decrypt(session('student_register_details')['phone']),
                        'otp' => $otp,
                        'type' => 'cdlogin'
                    ]
                );
                return redirect('phoneverification')->with('message','OTP sent! Kindly enter otp sent on your phone'); 
            } else {
                return redirect()->back()->with('message', 'Oops! something went wrong. Try Again !!');
            }
    }

    public function logout()
    {
        Session::remove('user');
        return redirect('/');
    }
}
