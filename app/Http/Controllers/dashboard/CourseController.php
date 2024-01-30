<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function courses(){
        $courses =  Course::all();
        return view('dashboard.course',['courses'=>$courses]);
    }

    public function createcourse(Request $request){
        $file = $request->file('icon');
        $path = $file->storeAs('public/courselogo',$file->getClientOriginalName());
        $expath =  explode('/',$path);

        Course::create([
            'name'=>$request->input('coursename'),
            'slug'=>urlencode(str_replace(",","",str_replace("&","",str_replace(" ","-",str_replace("/","-",str_replace(")","",str_replace("(","",strtolower($request->input('coursename'))))))))),
            'description'=>$request->input('description'),
            'icon'=>$expath[1].'/'.$expath[2]
        ]);
        return redirect()->back();
    }

    public function editCourse($id){
        $course =  Course::find($id);
        $courses = Course::all();
        return view('dashboard.course',['course'=>$course,'courses'=>$courses]);
    }

    public function updateCourse(Request $request){
        if($request->file('icon')){
            $courseIcon = Course::find($request->input('id'))->icon;
            try {
                //code...
                unlink(public_path('storage').'/'.$courseIcon);
            } catch (\Throwable $th) {
                //throw $th;
            }
            $file = $request->file('icon');
            $path = $file->storeAs('public/courselogo',$file->getClientOriginalName());
            $expath = explode('/',$path);
            Course::where('id',$request->input('id'))->update(
                [
                    'name'=>$request->input('coursename'),
                    'description'=>$request->input('description'),
                    'icon'=>$expath[1].'/'.$expath[2]
                ]
            );
        }else{
            Course::where('id',$request->input('id'))->update(
                [
                    'name'=>$request->input('coursename'),
                    'description'=>$request->input('description'),
                ]
            );
        }
        return redirect('dashboard/courses');
    }
    
}
