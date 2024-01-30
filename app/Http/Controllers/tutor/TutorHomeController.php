<?php

namespace App\Http\Controllers\tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TutorHomeController extends Controller
{
    public function home(){
        $home_data = array(
            'enrollments'=>10,
            'fee_structures'=>20,
            'achivements'=>20,
        );
        return view('tutor.home',$home_data);
    }
}
