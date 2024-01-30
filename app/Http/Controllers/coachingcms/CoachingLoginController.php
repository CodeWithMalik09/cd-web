<?php

namespace App\Http\Controllers\coachingcms;

use App\Http\Controllers\Controller;
use App\Models\Coaching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CoachingLoginController extends Controller
{
    public function login(){
        return view('coaching.login');
    }

    public function authenticate(Request $request){
        $user = Coaching::where([['email','=',$request->input('email')],['password','=',md5($request->input('password'))]])->get();
        // dd($request->input('password'));
        if($user->count() == 1){
            Session::put('coaching',$user[0]);
            return redirect('coachingcms/home');
        }else{
            return redirect()->back()->with('message','Invalid Credentials!!!');
        }
    }

    public function logout(){
        Session::remove('coaching');
        return redirect('coachingcms');
    }
}
