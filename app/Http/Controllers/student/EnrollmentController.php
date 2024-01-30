<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coaching;
use App\Models\Course;
use App\Models\StudentRegistrationDetail;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function enrollNow($coaching_id){
        $coaching = Coaching::find($coaching_id);
        $courses = Course::where('id',$coaching->main_course_id)->get();
        $categories = Category::whereIn('id',json_decode($coaching->categories))->select('name','id')->get();
        return view('enrollnow',['courses'=>$courses,'coaching'=>$coaching,'categories'=>$categories]);
    }

    public function enroll(Request $request){
        $enrollment_data = [
            'coaching_id'=>$request->input('coaching'),
            'course_id'=>$request->input('course'),
            'user_id'=>auth()->user()->id,
            'category_id'=>$request->input('course_category'),

            'name'=>$request->input('name'),
            'dob'=>$request->input('dob'),
            'gender'=>$request->input('gender'),
            'category'=>$request->input('category'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),

            'father_name'=>$request->input('fname'),
            'occupation'=>$request->input('occupation'),
            'father_mobile'=>$request->input('fmobile'),
        
            'address'=>$request->input('address'),
            'city'=>$request->input('city'),
            'state'=>$request->input('state'),
            'district'=>$request->input('district'),
            'pincode'=>$request->input('pincode'),

            'session'=>$request->input('session'),
            'centre'=>$request->input('centre'),
            'course'=>$request->input('course'),
            'batch_type'=>$request->input('batch_type'),
            'exam'=>$request->input('exam'),
            'stream'=>$request->input('stream'),
            'batch'=>$request->input('batch'),

            'qualification'=>$request->input('qualification'),
            'qualification_stream'=>$request->input('qualification_stream'),
            'college_name'=>$request->input('college'),
            'passing_year'=>$request->input('passing_year'),
            'marks'=>$request->input('marks'),
        ];

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $path = $file->storeAs('public/userphoto',$file->getClientOriginalName());
            $expath = explode('/',$path);
            $enrollment_data['photo'] = $expath[1].'/'.$expath[2];
        }

        if($request->hasFile('signature')){
            $file = $request->file('signature');
            $path = $file->storeAs('public/usersignature',$file->getClientOriginalName());
            $expath = explode('/',$path);
            $enrollment_data['signature'] = $expath[1].'/'.$expath[2];
        }

        if($request->hasFile('id_proof')){
            $file = $request->file('id_proof');
            $path = $file->storeAs('public/useridproof',$file->getClientOriginalName());
            $expath = explode('/',$path);
            $enrollment_data['id_proof'] = $expath[1].'/'.$expath[2];
        }



        StudentRegistrationDetail::create($enrollment_data);
        return redirect('/')->with('enrollment_message', 'Enrolled successfully.');
    }
}
