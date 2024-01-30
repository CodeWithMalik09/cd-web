<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Coaching;
use App\Models\Library;
use App\Models\Course;
use App\Models\OperationArea;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function login(){
        return view('dashboard.login');
    }

    public function logincheck(Request $request){
        $user = User::where([['email','=',$request->input('email')],['password','=',md5($request->input('password'))]])->get();
        // dd($request->input('password'));
        if($user->count() == 1){
            if($user[0]->role != "student" || $user[0]->role != "coaching" || $user[0]->role != "tutor"){
                Session::put('admin',$user[0]);
                Auth::login($user[0]);
                return redirect('dashboard');
            }else{
                return redirect()->back()->with('message','Invalid Credentials!!!');
            }
        }else{
            return redirect()->back()->with('message','Invalid Credentials!!!');
        }
    }

    public function logout(){
        Session::remove('admin');
        Auth::logout();
        return redirect('cms');
    }

    public function home(){
        $courses = Course::all();
        $cities = OperationArea::all();
        $blogs = Blog::all();
        if(auth()->user()->role == "operator"){
            $coachings = Coaching::where('added_by',auth()->user()->id)->get();
        }else{
            $coachings = Coaching::all();
        }
        $tutor = Tutor::all();
        $library = Library::all();

        $students = User::where('role','student')->get();
        $data = array(
            'courses'=>$courses->count(),
            'cities'=>$cities->count(),
            'blogs'=>$blogs->count(),
            'coachings'=>$coachings->count(),
            'tutors'=>$tutor->count(),
            'libraries'=>$library->count(),
            'students'=>$students->count(),
        );
        return view('dashboard.home',$data);
    }

    public function editProfile(){
        return view('dashboard.user.editprofile');
    }

}
