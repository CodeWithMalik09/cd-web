<?php

namespace App\Http\Controllers\coachingcms;

use App\Http\Controllers\Controller;
use App\Models\FacultyStaff;
use App\Models\FeeStructure;
use App\Models\ResultAndAchivement;
use Illuminate\Http\Request;

class CoachingHomeController extends Controller
{
    public function home(){
        $faculties = FacultyStaff::where('coaching_id',session('coaching')->id)->get()->count();
        $achivements = ResultAndAchivement::where('coaching_id',session('coaching')->id)->get()->count();
        $fee_structures = FeeStructure::where('coaching_id',session('coaching')->id)->get()->count();

        $data = array(
            'faculties'=>$faculties,
            'achivements'=>$achivements,
            'fee_structures'=>$fee_structures,
        );

        return view('coaching.home',$data);
    }
}
