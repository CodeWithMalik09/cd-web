<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Coaching;
use App\Models\Course;
use App\Models\StudentRegistrationDetail;
use App\Models\Tutor;
use App\Models\Wishlist;
use App\Models\Locality;
use App\Models\OperationArea;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function profile(){
        return view('student.profile');
    }

    public function wishlist(){
        $courses = Course::all();
        $coachings_wish = Wishlist::where([['type','=','coaching'],['user_id','=',session('user')->id]])->pluck('wish_id');
        $coachings = Coaching::whereIn('id',$coachings_wish)->get();
        foreach ($coachings as $key => $coaching) {
            $coaching->{'wishlisted'} = true;
        }
          $localities=Locality::all();
          $cities=OperationArea::all();
        $tutors_wish = Wishlist::where([['type','=','tutor'],['user_id','=',session('user')->id]])->get();
        $tutors = Tutor::whereIn('id',$tutors_wish)->get();
        return view('student.wishlist',['tutors'=>$tutors,'coachings'=>$coachings,'courses'=>$courses,'localities'=>$localities,'cities'=>$cities]);
    }

    public function enrollments(){
        $enrollments = StudentRegistrationDetail::where('user_id',auth()->user()->id)->get();
        return view('student.enrollments',['enrollments'=>$enrollments]);
    }
        public function printenrollment($id){
        $enrollments = StudentRegistrationDetail::where('id',$id)->get();
        return view('student.printpage',['enrollments'=>$enrollments]);
      }
}
