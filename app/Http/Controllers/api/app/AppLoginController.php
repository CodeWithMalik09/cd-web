<?php

namespace App\Http\Controllers\api\app;

use App\Http\Controllers\Controller;
use App\Models\etweet\EtUserDetail;
use App\Models\User;
use App\Models\VerificationOtp;
use App\traits\SendSMS;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AppLoginController extends Controller
{
    use SendSMS;


    public function checkUsername(Request $request)
    {
        $user = User::where('username', $request->input('username'))->get();
        if ($user->count() == 1) {
            return response()->json(['message' => 'Username already exists', 'status' => 'fail'], 400);
        } else {
            return response()->json(['message' => 'available', 'status' => 'success'], 200);
        }
    }

    public function sendOtp(Request $request)
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
            return response()->json(['message' => 'OTP sent successfully.', 'status' => 'success'], 200);
        } else {
            return response()->json(['message' => 'Oops! something went wrong.', 'status' => 'fail'], 401);
        }

        // if ($request->type == "login") {
        //     $user = User::where('phone', $request->phone)->get();
        //     if ($user->count() == 1) {

        //     } else {
        //         return response()->json(['message' => 'Phone number not registered.', 'status' => 'fail'], 401);
        //     }
        // } else {
        //     if ($request->type == "register") {
        //         $otp = rand(1000, 9999);
        //         $otp_res = $this->SendOtpToNumber($request->phone, $otp);
        //         if ($otp_res->status == "success") {
        //             VerificationOtp::create(
        //                 [
        //                     'phone' => $request->phone,
        //                     'otp' => $otp,
        //                     'type' => 'cdlogin'
        //                 ]
        //             );
        //             return response()->json(['message' => 'OTP sent successfully.', 'status' => 'success'], 200);
        //         } else {
        //             return response()->json(['message' => 'Oops! something went wrong.', 'status' => 'fail'], 401);
        //         }
        //     } else {
        //         return response()->json(['message' => "Phone number is not registered. <a href='" . url("/login?register=true") . "' style='color:blue;'>Click here to register.</a>", 'status' => 'fail'], 200);
        //     }
        // }
    }

    public function verifyOTP(Request $request)
    {


        $check_otp = VerificationOtp::where('phone', $request->phone)->where('otp', $request->otp)->where('created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString())->get();
        if ($check_otp->count() == 1) {
            $user = User::where('phone', $request->input('phone'))->get();
            if ($user->count() == 1) {
                $user = $user->first();
                if ($user->userDetail['image']) {
                    $user->{'image'} = url('storage') . '/' . $user->userDetail['image'];
                } else {
                    $user->{'image'} = asset('assets/boy.png');
                }
                $token = $user->createToken('appauth', ['server:update'])->plainTextToken;
                unset($user->userDetail);
                return response()->json(['status' => 'success', 'message' => 'User logined successfully.', 'token' => $token, "user" => $user], 200);
            } else {
                return response()->json(['message' => 'Phone number verified', 'status' => 'success', 'redirect_to' => 'register'], 401);
            }
        } else {
            return response()->json(['message' => 'Invalid OTP', 'status' => 'fail'], 401);
        }

        // $user = User::where('phone', $request->input('phone'))->get();
        // if ($user->count() == 1) {


        //     $user = $user->first();
        //     if ($user->userDetail['image']) {
        //         $user->{'image'} = url('storage') . '/' . $user->userDetail['image'];
        //     } else {
        //         $user->{'image'} = asset('assets/boy.png');
        //     }
        //     $token = $user->createToken('appauth', ['server:update'])->plainTextToken;
        //     unset($user->userDetail);
        //     return response()->json(['status' => 'success', 'message' => 'User logined successfully.', 'token' => $token, "user" => $user], 200);
        // } else {
        //     return response()->json(['message' => 'not found', 'content' => 'User not found'], 200);
        // }
    }


    public function login(Request $request)
    {
        $user = User::where('phone', $request->username)
            ->orWhere('username', $request->username)
            ->orWhere('email', $request->username)
            ->get();
        if ($user->count() != 1) {
            return response()->json(['message' => 'Invalid credentials'], 200);
        }
        // $user = User::where([['phone', '=', $request->input('username')], ['password', '=', md5($request->input('password'))]])->get();
        if ($user->first()->password == md5($request->input('password'))) {
            $token = $user[0]->createToken("appauth", ['server:update'])->plainTextToken;
            $user = $user[0];
            if ($user->userDetail['image']) {
                $user->{'image'} = url('storage') . '/' . $user->userDetail['image'];
            } else {
                $user->{'image'} = asset('assets/boy.png');
            }
            unset($user->userDetail);
            return response()->json(['message' => 'success', 'token' => $token, 'user' => $user], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 200);
        }
    }

    public function register(Request $request)
    {
         //return response()->json(['message' => 'exists', 'request' => $request,'content' => 'Request Testingg!'], 200);
        $user = User::where('username', $request->input('username'))->get();
        if ($user->count() == 1) {
            return response()->json(['message' => 'exists', 'content' => 'Username already exists.'], 200);
        } else {
            $check_phone = User::where('phone', $request->input('phone'))->get();
            if ($check_phone->count() >= 1) {
                return response()->json(['message' => 'exists', 'content' => 'Mobile number already exists!'], 200);
            } else {
                $check_email = User::where('email', $request->input('email'))->get();
                if ($check_email->count() >= 1) {
                    return response()->json(['message' => 'exists', 'content' => 'Email id already exists!'], 200);
                } else {
                    $user = User::create(
                        [
                            'name' => $request->input('name'),
                            'phone' => $request->input('phone'),
                            'email' => $request->input('email'),
                            'username' => $request->input('username'),
                            'password' => Hash::make(rand(100000, 999999))
                        ]
                    );
                    EtUserDetail::create(
                        [
                            'user_id' => $user->id,
                            // 'dob'=>$request->input('dob'),
                        ]
                    );

                    $user = $user->find($user->id);
                    if ($user->userDetail['image']) {
                        $user->{'image'} = url('storage') . '/' . $user->userDetail['image'];
                    } else {
                        $user->{'image'} = asset('assets/boy.png');
                    }
                    unset($user->userDetail);

                    $token = $user->createToken('appauth', ['server:update'])->plainTextToken;
                    return response()->json(['message' => 'success', 'token' => $token, 'user' => $user], 200);
                }
            }
        }
    }



    public function updateProfile(Request $request)
    {
        $data = [
            'bio' => $request->input('aboutme'),
            'location' => $request->input('location'),
            'website_link' => $request->input('website_link'),
            'dob' => date('y-m-d', strtotime($request->input('dob'))),
        ];

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $path = $file->store('public/etprofile');
            $expath = explode('/', $path);
            $data['image'] = $expath[1] . '/' . $expath[2];
        }

        if ($request->hasFile('background_image')) {
            $file = $request->file('background_image');
            $path = $file->store('public/etthumbnail');
            $expath = explode('/', $path);
            $data['thumbnail'] = $expath[1] . '/' . $expath[2];
        }


        EtUserDetail::where('user_id', auth()->user()->id)->update($data);
        return response()->json(['message' => 'success'], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'success'], 200);
    }
}
