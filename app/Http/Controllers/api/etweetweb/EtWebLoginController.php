<?php

namespace App\Http\Controllers\api\etweetweb;

use App\Http\Controllers\Controller;
use App\Models\etweet\EtUserDetail;
use App\Models\User;
use App\Models\VerificationOtp;
use App\traits\SendSMS;
use Illuminate\Http\Request;

class EtWebLoginController extends Controller
{
    use SendSMS;

    public function checkUsername(Request $request)
    {
        $user = User::where('username', $request->input('username'))->get();
        if ($user->count() == 1) {
            return response()->json(['message' => 'exists'], 200);
        } else {
            return response()->json(['message' => 'available'], 200);
        }
    }


    public function sendOtp(Request $request)
    {

        if ($request->type == "login") {
            $user = User::where('phone', $request->username)->get();
            if ($user->count() == 1) {
                $otp = rand(1000, 9999);
                $otp_res = $this->SendOtpToNumber($request->username, $otp);
                if ($otp_res->status == "success") {
                    VerificationOtp::create(
                        [
                            'phone' => $request->username,
                            'otp' => $otp,
                            'type' => 'etlogin'
                        ]
                    );
                    return response()->json(['message' => 'OTP sent successfully.', 'status' => 'success'], 200);
                } else {
                    return response()->json(['message' => 'Oops! something went wrong.', 'status' => 'fail'], 401);
                }
            } else {
                return response()->json(['message' => 'Phone number not registered.', 'status' => 'fail'], 401);
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
                    return response()->json(['message' => 'Oops! something went wrong.', 'status' => 'fail'], 401);
                }
            } else {
                return response()->json(['message' => "Phone number is not registered. <a href='" . url("/login?register=true") . "' style='color:blue;'>Click here to register.</a>", 'status' => 'fail'], 200);
            }
        }
    }


    public function verifyOTP(Request $request)
    {
        $user = User::where('phone', $request->input('phone'))->get();
        if ($user->count() == 1) {


            $check_otp = VerificationOtp::where('phone', $request->phone)->get();
            if ($check_otp->count() == 0) {
                return response()->json(['message' => 'Invalid OTP'], 401);
            } else if ($check_otp->last()->otp != $request->otp) {
                return response()->json(['message' => 'Invalid OTP'], 401);
            }

            $user = $user->first();
            if ($user->userDetail['image']) {
                $user->{'image'} = url('storage') . '/' . $user->userDetail['image'];
            } else {
                $user->{'image'} = asset('assets/boy.png');
            }
            $token = $user->createToken('appauth', ['server:update'])->plainTextToken;
            unset($user->userDetail);
            return response()->json(['message' => 'success', 'token' => $token, "user" => $user], 200);
        } else {
            return response()->json(['message' => 'not found', 'content' => 'User not found'], 200);
        }
    }


    public function login(Request $request)
    {

        $user = User::where([['phone', '=', $request->input('username')], ['password', '=', md5($request->input('password'))]])->get();
        if ($user->count() == 1) {
            $token = $user[0]->createToken("webauth", ['server:update'])->plainTextToken;
            return response()->json(['message' => 'success', 'token' => $token], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 200);
        }
    }

    public function register(Request $request)
    {
        $user = User::where('username', $request->input('username'))->get();
        if ($user->count() == 1) {
            return response()->json(['message' => 'Username already exists.'], 200);
        } else {
            $check_phone = User::where('phone', $request->input('phone'))->get();
            if ($check_phone->count() >= 1) {
                return response()->json(['message' => 'Mobile number already exists!'], 200);
            } else {
                $user = User::create(
                    [
                        'name' => $request->input('name'),
                        'phone' => $request->input('phone'),
                        'username' => $request->input('username'),
                        'password' => md5($request->input('password')),
                    ]
                );
                EtUserDetail::create(
                    [
                        'user_id' => $user->id,
                        // 'dob'=>$request->input('dob'),
                    ]
                );
                $token = $user->createToken('webauth', ['server:update'])->plainTextToken;
                return response()->json(['message' => 'success', 'token' => $token], 200);
            }
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'success'], 200);
    }
}
