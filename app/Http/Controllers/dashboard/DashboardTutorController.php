<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\TutorCourse;
use App\Models\OperationArea;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class DashboardTutorController extends Controller
{
    public function tutor(){
        $tutors = Tutor::all();
        return view('dashboard.tutor.tutor',['tutors'=>$tutors]);
    }

    public function createTutor(Request $request){
        $cities = OperationArea::all();
        $courses = TutorCourse::all();
        return view('dashboard.tutor.create',['cities'=>$cities,'courses'=>$courses]);
    }

    public function insertTutor(Request $request){

        $remove_aps = str_replace("'", "", $request->input('tutorname'));
        $remove_amp = str_replace("&", "", $remove_aps);
        $remove_slash = str_replace("/", "-", $remove_amp);
        $slug = implode('-', explode(' ', strtolower($remove_slash)));
        $cities = OperationArea::whereIn('id', [$request->input('city')])->pluck('name');
        $slug = $slug . '-' . strtolower($cities[0]);

        $tutor_data = [
            'course' => json_encode($request->input('courses')),
            'name'=>$request->input('tutorname'),
            'slug'=> $slug,
            'dob'=>$request->input('dob'),
            'gender'=>$request->input('gender'),
            'city'=>$request->input('city'),
            'email'=>$request->input('email'),
            'phone'=>$request->input('phone'),
            'alternate_phone'=>$request->input('altphone'),
            'present_address'=>$request->input('address'),
            'qualification_details'=>$request->input('qd'),
            'teaching_experience'=>$request->input('experience'),
            'tandc'=>$request->input('tandc'),
            'fee_per_hour'=>$request->input('fee_per_hour'),
            'fee_per_month'=>$request->input('fee_per_month'),
            'about'=>$request->input('about'),
            'board' => $request->input('board'),
            'specialization' => $request->input('specialization'),
            'subjects' => $request->input('subjects'),
            'free_demo_class' => $request->input('free_demo_class'),
            'status' => 'approved'
        ];

        if($request->hasFile('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->getClientOriginalName();
            $path = $thumbnail->storeAs('public/tutorthumbnail',$thumbnail_name);
            $thumb_ext = explode('/',$path);
            $tutor_data['thumbnail'] = $thumb_ext[1].'/'.$thumb_ext[2];
        }

        $galarr = array();
        if($request->hasFile('gallery')){
            foreach ($request->file('gallery') as $item) {
                $img_name = $item->getClientOriginalName();
                $path = $item->storeAs('public/tutorgallery',$img_name);
                $extpath = explode('/',$path);
                array_push($galarr,$extpath[1].'/'.$extpath[2]);
            }

            $tutor_data['gallery'] = json_encode($galarr);

        }
        
        Tutor::create(
            $tutor_data,
        );
        return redirect('dashboard/tutors');
    }

    public function editTutor($id){
        $cities = OperationArea::all();
        $tutor = Tutor::find($id);
        $courses =  TutorCourse::all();
        Session::put('redirected_from', $_SERVER['HTTP_REFERER']);
        return view('dashboard.tutor.edit',['tutor'=>$tutor,'cities'=>$cities,'courses'=>$courses]);
    }

    public function updateTutor(Request $request){
        $remove_aps = str_replace("'", "", $request->input('tutorname'));
        $remove_amp = str_replace("&", "", $remove_aps);
        $remove_slash = str_replace("/", "-", $remove_amp);
        $slug = implode('-', explode(' ', strtolower($remove_slash)));
        $cities = OperationArea::whereIn('id', [$request->input('city')])->pluck('name');
        $slug = $slug . '-' . strtolower($cities[0]);

        $updateArr = array(
            'course'=>json_encode($request->input('courses')),
            'slug'=> $slug,
            'name'=>$request->input('tutorname'),
            'dob'=>$request->input('dob'),
            'gender'=>$request->input('gender'),
            'city'=>$request->input('city'),
            'email'=>$request->input('email'),
            'phone'=>$request->input('phone'),
            'alternate_phone'=>$request->input('altphone'),
            'present_address'=>$request->input('address'),
            'fee_per_hour'=>$request->input('fee_per_hour'),
            'fee_per_month'=>$request->input('fee_per_month'),
            'qualification_details'=>$request->input('qd'),
            'teaching_experience'=>$request->input('experience'),
            'tandc'=>$request->input('tandc'),
            'about'=>$request->input('about'),
            'board' => $request->input('board'),
            'specialization' => $request->input('specialization'),
            'subjects' => $request->input('subjects'),
            'free_demo_class' => $request->input('free_demo_class'),
            'status' => 'approved'
        );

        if($request->input('password')){
            $updateArr['password'] = md5($request->input('password'));
        }

        if($request->hasFile('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->getClientOriginalName();
            $path = $thumbnail->storeAs('public/tutorthumbnail',$thumbnail_name);
            $thumb_ext = explode('/',$path);
            $updateArr['thumbnail']  = $thumb_ext[1].'/'.$thumb_ext[2];
        }

        if($request->hasFile('gallery')){
            $gallery = $request->file('gallery');
            $galarr = array();
            if($request->hasFile('gallery')){
                foreach ($gallery as $item) {
                    // $img_name = $item->getClientOriginalName();
                    $path = $item->store('public/tutorgallery');
                    $extpath = explode('/',$path);
                    array_push($galarr,$extpath[1].'/'.$extpath[2]);
                }
            }
            $updateArr['gallery'] = json_encode($galarr);
        }
        
        Tutor::find($request->input('id'))->update(
            $updateArr
        );

        return redirect(session('redirected_from'))->with('message', 'Tutor updated successfully.');
    }

    public function deleteTutor($id){
        Tutor::find($id)->delete();
        return redirect()->back()->with('message', 'Tutor deleted successfully.');
    }

    public function searchTutor(Request $request)
    {
        if (!$request->search) {
            return redirect("/dashboard/tutors");
        }

        $tutors = Tutor::where('status', 'approved');

        if (str_contains($request->search, ',')) {
            $search = explode(',', $request->search);
            $tutors->where('name', 'like', '%' . $search[0] . '%');
            $tutors->orWhere('city', 'like', '%' . $search[1] . '%');
        } else {
            $tutors->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('city', 'like', '%' . $request->search . '%')
                ->orWhere('present_address', 'like', '%' . $request->search . '%')
                ->orderBy('id', 'desc');
        }


        $tutors = $tutors->get();
        return view('dashboard.tutor.tutor', ['tutors' => $tutors, "search" => $request->search]);
    }
}
