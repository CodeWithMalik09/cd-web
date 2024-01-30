<?php

namespace App\Http\Controllers\tutor;

use App\Http\Controllers\Controller;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TutorLoginController extends Controller
{
    public function login(){
        return view('tutor.login');
    }

    public function authenticate(Request $request){
        $user = Tutor::where([['email','=',$request->input('email')],['password','=',md5($request->input('password'))]])->get();
        // dd($request->input('password'));
        if($user->count() == 1){
            Session::put('tutor',$user[0]);
            return redirect('tutorcms');
        }else{
            return redirect()->back()->with('message','Invalid Credentials!!!');
        }
    }

    public function logout(){
        Session::remove('tutor');
        return redirect('tutorcms/login');
    }
}
