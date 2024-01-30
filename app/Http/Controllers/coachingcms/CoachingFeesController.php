<?php

namespace App\Http\Controllers\coachingcms;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\FeeStructure;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class CoachingFeesController extends Controller
{
    public function index(){
        $fee_structures = FeeStructure::where('coaching_id',session('coaching')->id)->get();
        return view('coaching.fees.index',['fee_structures'=>$fee_structures]);
    }

    public function createView(){
        $courses = Course::all();
        return view('coaching.fees.create',['courses'=>$courses]);
    }

    public function create(Request $request){
        $fee_data = array(
            'coaching_id'=>session('coaching')->id,
            'course_id'=>$request->input('course'),
            'stream'=>$request->input('stream'),
            'type'=>$request->input('type'),
            'fees'=>$request->input('fees'),
            'batch_starting_date'=>$request->input('batch_starting_date'),
            'scholarship_discount'=>$request->input('scholarship_discount'),
            'admission_process'=>$request->input('admission_process'),
            'remarks'=>$request->input('remarks'),
        );

        FeeStructure::create(
            $fee_data
        );

        return redirect('coachingcms/fees');
    }

    public function editView($id){
        $fee_structure = FeeStructure::find($id);
        $courses = Course::all();
        return view('coaching.fees.edit',['fee_structure'=>$fee_structure,'courses'=>$courses]);
    }

    public function update(Request $request){
        $fee_data = array(
            'coaching_id'=>session('coaching')->id,
            'course_id'=>$request->input('course'),
            'stream'=>$request->input('stream'),
            'type'=>$request->input('type'),
            'fees'=>$request->input('fees'),
            'batch_starting_date'=>$request->input('batch_starting_date'),
            'scholarship_discount'=>$request->input('scholarship_discount'),
            'admission_process'=>$request->input('admission_process'),
            'remarks'=>$request->input('remarks'),
            'updated_at'=>Carbon::now(),
        );

        FeeStructure::find($request->input('id'))->update(
            $fee_data
        );

        return redirect('coachingcms/fees')->with('status','Fee structure updated successfully.');
    }

    public function delete($id){
        FeeStructure::find($id)->delete();
        return redirect()->back()->with('status','Fee structure deleted successfully.');
    }
}
