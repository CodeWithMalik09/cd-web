<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coaching;
use App\Models\Course;
use App\Models\FeeStructure;
use App\Models\OperationArea;

class DashboardFeeStructureController extends Controller
{
    public function create(){
        $courses = Course::all();
        $coachings = Coaching::select('id','name','cities')->get();

        foreach ($coachings as $coaching) {
            $cities = OperationArea::whereIn('id',json_decode($coaching->cities))->pluck('name');
            $coaching->{'operation_areas'} = $cities;
        }

        $data = [
            'courses'=>$courses,
            'coachings'=>$coachings
        ];
        return view('dashboard.feestructure.new',$data);
    }

    public function store(Request $request){
        $data = [
            'coaching_id'=>$request->coaching_id,
            'course_id'=>$request->course_id,
            'stream'=>$request->stream,
            'type'=>$request->type,
            'admission_process'=>$request->admission_process,
            'batch_starting_date'=>$request->batch_starting_date,
            'fees'=>$request->fees,
            'scholarship_discount'=>$request->scholarship_discount,
            'remarks'=>$request->remarks,
        ];

        FeeStructure::create($data);

        return redirect()->back()->with('message','Fee structure added successfully.');
    }
}
