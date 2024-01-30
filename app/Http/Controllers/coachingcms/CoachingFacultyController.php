<?php

namespace App\Http\Controllers\coachingcms;

use App\Http\Controllers\Controller;
use App\Models\FacultyStaff;
use Illuminate\Http\Request;

class CoachingFacultyController extends Controller
{
    public function index(){
        $faculties = FacultyStaff::where('coaching_id',session('coaching')->id)->get();
        return view('coaching.faculty.view',['faculties'=>$faculties]);
    }

    public function createView(){
        return view('coaching.faculty.create');
    }

    public function create(Request $request){
        $faculty_data = array(
            'coaching_id'=>session('coaching')->id,
            'name'=>$request->input('name'),
            'designation'=>$request->input('designation'),
            'specialization_on'=>$request->input('specialization_on'),
            'university'=>$request->input('university'),
            'college'=>$request->input('college'),
            'experience_in_years'=>$request->input('experience'),
            'job_type'=>$request->input('jobtype'),
            'achivements'=>$request->input('achivements'),
            'remarks'=>$request->input('remarks'),
        );

        FacultyStaff::create(
            $faculty_data
        );
        return redirect('coachingcms/faculties');
    }

    public function editView($id){
        $faculty = FacultyStaff::find($id);
        return view('coaching.faculty.edit',['faculty'=>$faculty]);
    }

    public function update(Request $request){
        $faculty_data = array(
            'name'=>$request->input('name'),
            'designation'=>$request->input('designation'),
            'specialization_on'=>$request->input('specialization_on'),
            'university'=>$request->input('university'),
            'college'=>$request->input('college'),
            'experience_in_years'=>$request->input('experience'),
            'job_type'=>$request->input('jobtype'),
            'achivements'=>$request->input('achivements'),
            'remarks'=>$request->input('remarks'),
        );

        FacultyStaff::find($request->input('id'))->update(
            $faculty_data
        );

        return redirect('coachingcms/faculties');
    }

    public function delete($id){
        FacultyStaff::find($id)->delete();
        return redirect()->back()->with('status','Faculty deleted successfully.');
    }
}
