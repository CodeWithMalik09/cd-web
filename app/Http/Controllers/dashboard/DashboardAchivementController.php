<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coaching;
use App\Models\Course;
use App\Models\OperationArea;
use App\Models\ResultAndAchivement;

class DashboardAchivementController extends Controller
{
    public function create()
    {
        $courses = Course::all();
        $coachings = Coaching::select('id', 'name', 'cities')->get();

        foreach ($coachings as $coaching) {
            $cities = OperationArea::whereIn('id', json_decode($coaching->cities))->pluck('name');
            $coaching->{'operation_areas'} = $cities;
        }

        $data = [
            'courses' => $courses,
            'coachings' => $coachings
        ];
        return view('dashboard.resultAndAchivement.new', $data);
    }

    public function store(Request $request)
    {
        $data = [
            'coaching_id'=>$request->coaching_id,
            'course_id'=>$request->course_id,
            'exam_year'=>$request->exam_year,
            'stream'=>$request->stream,
            'selected_in_pt'=>$request->selected_in_pt,
            'selected_in_mains'=>$request->selected_in_mains,
            'selected_in_final'=>$request->selected_in_final,
            'selected_in_top_ten'=>$request->selected_in_top_ten,
            'remarks'=>$request->remarks,
        ];

        ResultAndAchivement::create($data);

        return redirect()->back()->with('message','Result and achivement created successfully.');
    }
}
