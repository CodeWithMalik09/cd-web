<?php

namespace App\Http\Controllers\api\app\student;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coaching;
use App\Models\Course;
use App\Models\StudentRegistrationDetail;
use Illuminate\Http\Request;

class AppEnrollmentController extends Controller
{

    public function enrollNow($coaching_id){
        $coaching = Coaching::find($coaching_id);
        $courses = Course::where('id',$coaching->main_course_id)->get();
        $categories = Category::whereIn('id',json_decode($coaching->categories))->select('name','id')->get();
        return response()->json(['message' => 'success', 'categories' => $categories, 'courses' => $courses, 'coaching'=>$coaching], 200);
    }

    public function enroll(Request $request){
        $enrollment_data = [
            'coaching_id'=>$request->coaching_id,
            'course_id'=>$request->course_id,
            'user_id'=>auth()->user()->id,
            'category_id'=>$request->category_id,

            'name'=>$request->name,
            'dob'=>$request->dob,
            'gender'=>$request->gender,
            'category'=>$request->category,
            'email'=>$request->email,
            'mobile'=>$request->mobile,

            'father_name'=>$request->father_name,
            'occupation'=>$request->occupation,
            'father_mobile'=>$request->father_mobile,
        
            'address'=>$request->address,
            'city'=>$request->city,
            'state'=>$request->state,
            'district'=>$request->district,
            'pincode'=>$request->pincode,

            'session'=>$request->session,
            'centre'=>$request->centre,
            'course'=>$request->course,
            'batch_type'=>$request->batch_type,
            'exam'=>$request->exam,
            'stream'=>$request->stream,
            'batch'=>$request->batch,

            'qualification'=>$request->qualification,
            'qualification_stream'=>$request->qualification_stream,
            'college_name'=>$request->college_name,
            'passing_year'=>$request->passing_year,
            'marks'=>$request->marks,
        ];

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $path = $file->store('public/userphoto');
            $expath = explode('/',$path);
            $enrollment_data['photo'] = $expath[1].'/'.$expath[2];
        }

        if($request->hasFile('signature')){
            $file = $request->file('signature');
            $path = $file->store('public/usersignature');
            $expath = explode('/',$path);
            $enrollment_data['signature'] = $expath[1].'/'.$expath[2];
        }

        if($request->hasFile('id_proof')){
            $file = $request->file('id_proof');
            $path = $file->store('public/useridproof');
            $expath = explode('/',$path);
            $enrollment_data['id_proof'] = $expath[1].'/'.$expath[2];
        }

        StudentRegistrationDetail::create($enrollment_data);
        return response()->json(['message' => 'success'], 200);
    }

    public function enrollments(){
        $enrollments = StudentRegistrationDetail::where('user_id',auth()->user()->id)->get();
        return response()->json(['message' => 'success', 'enrollments' => $enrollments], 200);
    }
}
