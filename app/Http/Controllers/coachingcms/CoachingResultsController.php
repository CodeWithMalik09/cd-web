<?php

namespace App\Http\Controllers\coachingcms;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ResultAndAchivement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CoachingResultsController extends Controller
{
    public function index(){
        $results = ResultAndAchivement::where('coaching_id',session('coaching')->id)->get();
        return view('coaching.results.index',['results'=>$results]);
    }

    public function createView(){
        $courses = Course::all();
        return view('coaching.results.create',['courses'=>$courses]);
    }

    public function create(Request $request){
        $result_data = array(
            'coaching_id'=>session('coaching')->id,
            'course_id'=>$request->input('course'),
            'exam_year'=>$request->input('exam_year'),
            'type'=>$request->input('type'),
            'stream'=>$request->input('stream'),
            'selected_in_pt'=>$request->input('selected_in_pt'),
            'selected_in_mains'=>$request->input('selected_in_mains'),
            'selected_in_final'=>$request->input('selected_in_final'),
            'selected_in_top_ten'=>$request->input('selected_in_top_ten'),
            'remarks'=>$request->input('remarks'),
        );

        ResultAndAchivement::create(
            $result_data
        );
        return redirect('coachingcms/results');
    }

    public function editView($id){
        $courses = Course::all();
        $result = ResultAndAchivement::find($id);
        return view('coaching.results.edit',['courses'=>$courses,'result'=>$result]);
    }

    public function update(Request $request){
        $result_data = array(
            'course_id'=>$request->input('course'),
            'exam_year'=>$request->input('exam_year'),
            'type'=>$request->input('type'),
            'stream'=>$request->input('stream'),
            'selected_in_pt'=>$request->input('selected_in_pt'),
            'selected_in_mains'=>$request->input('selected_in_mains'),
            'selected_in_final'=>$request->input('selected_in_final'),
            'selected_in_top_ten'=>$request->input('selected_in_top_ten'),
            'remarks'=>$request->input('remarks'),
            'updated_at'=>Carbon::now(),
        );

        ResultAndAchivement::find($request->input('id'))->update(
            $result_data
        );

        return redirect('coachingcms/results')->with('status','Result and Achivement updated successfully');
    }

    public function delete($id){
        ResultAndAchivement::find($id)->delete();
        return redirect('coachingcms/results')->with('status','Result and Achivement deleted successfully');
    }
}
