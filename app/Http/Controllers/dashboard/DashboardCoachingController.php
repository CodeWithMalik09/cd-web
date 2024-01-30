<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coaching;
use App\Models\NewCoaching;
use App\Models\CoachingGallery;
use App\Models\NewCoachingGallery;
use App\Models\Course;
use App\Models\FacultyStaff;
use App\Models\FeeStructure;
use App\Models\OperationArea;
use App\Models\Locality;
use App\Models\SeoKeyword;
use App\Models\ResultAndAchivement;
use App\Models\CoachingWorkingHours;
use App\Models\StudentRegistrationDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardCoachingController extends Controller
{
    public function coachings()
    {
        if (auth()->user()->role == "admin" || auth()->user()->email == "surabhi@taquino.in") {
            $coachings = Coaching::where('status', 'approved')->orderBy('id', 'desc')->paginate(25);
        } else {
            $coachings = Coaching::where('status', 'approved')->where('added_by', auth()->user()->id)->orderBy('id', 'desc')->paginate(25);
        }
        $cities = OperationArea::select('id','name')->get();
        $cityList = array();
        foreach($cities as $city)
        {
            $cityList[$city['id']] = $city['name'];
        }
        return view('dashboard.coaching.coachings', ['coachings' => $coachings, 'citylist' => $cityList]);
    }

    public function searchCoaching(Request $request)
    {

        if (!$request->search) {
            return redirect("/dashboard/coachings");
        }

        $coachings = Coaching::where('status', 'approved');

        if (str_contains($request->search, ',')) {
            $search = explode(',', $request->search);
            // dd($search);
            $coachings->where('name', 'like', '%' . $search[0] . '%');
            $coachings->orWhere('state', 'like', '%' . $search[1] . '%');
            // $coachings->where(function($query) use($search){
            // });
        } else {
            $coachings->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('state', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('district', 'like', '%' . $request->search . '%')
                ->orderBy('id', 'desc');
        }


        $coachings = $coachings->get();
        $cities = OperationArea::select('id','name')->get();
        $cityList = array();
        foreach($cities as $city)
        {
            $cityList[$city['id']] = $city['name'];
        }
        // if (auth()->user()->role == "admin") {
        // } else {
        //     // $city = OperationArea::where('name','like','%'.$request->search.'%')->get();
        //     // foreach ($variable as $key => $value) {
        //     //     # code...
        //     // }
        //     $coachings = Coaching::where('status', 'approved')
        //         ->where('added_by', auth()->user()->id)
        //         ->where('name', 'like', '%' . $request->search . '%')
        //         ->orderBy('id', 'desc')
        //         ->paginate(25);
        // }
        return view('dashboard.coaching.coachings', ['coachings' => $coachings, 'citylist' => $cityList, "search" => $request->search]);
    }

    public function unapprovedCoachings()
    {
        if (auth()->user()->role == "admin") {
            $coachings = Coaching::where('status', 'pending')->orderBy('id', 'desc')->paginate(25);
        } else {
            $coachings = Coaching::where('status', 'pending')->where('added_by', auth()->user()->id)->orderBy('id', 'desc')->paginate(25);
        }
        return view('dashboard.coaching.coachings', ['coachings' => $coachings, 'type' => 'unapproved']);
    }

      public function applied()
    {
        if (auth()->user()->role == "admin") {
            $coachings = NewCoaching::where('status', 'pending')->orderBy('id', 'desc')->paginate(25);
        } else {
            $coachings = NewCoaching::where('status', 'pending')->where('added_by', auth()->user()->id)->orderBy('id', 'desc')->paginate(25);
        }
        return view('dashboard.coaching.appliedcoachings', ['coachings' => $coachings, 'type' => 'unapproved']);
    }
   public function seokeywords()
    {
        $categories=Category::all();
        $courses=Course::all();
        $cities=OperationArea::all();
        if (auth()->user()->role == "admin" || auth()->user()->email == "armanmlk360@gmail.com" || auth()->user()->email == "Sami.taquino@gmail.com") {
            $keywords = SeoKeyword::all();
        } else {
            $keywords = SeoKeyword::all();
        }
        return view('dashboard.coaching.allkeywords', ['keywords' => $keywords,'categories'=>$categories,'courses'=>$courses,'cities'=>$cities]);
    }
    public function addkeywords()
    {
       $category=Category::all();
       $course=Course::all();
       $city=OperationArea::all();
       return view('dashboard.coaching.addkeywords',['category' =>$category,'course'=>$course,'city'=>$city]);
    }
    public function insertkeyword(Request $request)
    {
        SeoKeyWord::create([
            'category' => $request->input('type'),
            'course' => $request->input('course'),
            'city' => $request->input('city'),
            'key1' => $request->input('key1'),
            'key2' => $request->input('key2'),
            'title'   => $request->input('title'),
              'meta'   => $request->input('meta'),
              'ogtitle'   => $request->input('ogtitle'),
              'ogdesc'   => $request->input('ogdesc'),
              'ogtype'   => $request->input('ogtype'),
              'ogurl'   => $request->input('ogurl'),
              'canonical'   => $request->input('canonical'),
            'key3' => $request->input('key3')
        ]);
        return redirect()->back()->with('message', 'Content Added Successfully.');
    }
    public function editkeyword($id){
        $Keyword=SeoKeyword::find($id);
        $city=OperationArea::all();
        $course=Course::all();
        $category=Category::all();
        return view('dashboard.coaching.editkeywords',['keyword' =>$Keyword,'course'=>$course,'category'=>$category,'city'=>$city ]);
    }
    public function updatekeyword(Request $request){
       $updatearr=[
        'category'=> $request->input('type'),
        'course' => $request->input('course'),
        'city'   => $request->input('city'),
        'key1'   => $request->input('key1'),
        'key2'   => $request->input('key2'),
        'title'   => $request->input('title'),
        'meta'   => $request->input('meta'),
        'ogtitle'   => $request->input('ogtitle'),
        'ogdesc'   => $request->input('ogdesc'),
        'ogtype'   => $request->input('ogtype'),
        'ogurl'   => $request->input('ogurl'),
        'canonical'   => $request->input('canonical'),
        'key3'   => $request->input('key3')
       ];

       SeoKeyword::find($request->input("id"))->update(
        $updatearr
    );
    return redirect()->back()->with('message', 'Content updated Successfully.');
    }
public function deletekeyword($id){
    SeoKeyword::find($id)->delete();
    return redirect()->back()->with('message', 'Keyword deleted successfully.');
}

    public function approveCoaching($id)
    {
        Coaching::find($id)->update([
            'status' => 'approved'
        ]);
        return redirect('dashboard/coachings');
    }

    public function createCoaching()
    {
        $cities = OperationArea::all();
        $courses = Course::all();
        $categories = Category::all();
        $localities=Locality::all();
        return view('dashboard.coaching.create', ['cities' => $cities, 'courses' => $courses, 'categories' => $categories,'localities' => $localities]);
    }

    public function insertCoaching(Request $request)
    {
        $updatearr =  [
            'added_by' => auth()->user()->id,
            'name' => $request->input('name'),
            'main_course_id' => $request->main_course_id,
            // 'courses' => json_encode($request->input('courses')),
            'categories' => json_encode($request->input('categories')),
            'cities' => json_encode([$request->input('cities')]),
            'locality' => json_encode($request->input('locality')),
            'streams' => $request->input('streams'),
            'address' => $request->input('address'),
            'landmark' => $request->input('landmark'),
            'district' => $request->input('district'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
            'pincode' => $request->input('pincode'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'youtube_video_link' => $request->input('youtube_video_link'),

            'email' => $request->input('email'),
            'website' => $request->input('website'),
            'facebook_link' => $request->input('facebook_link'),
            'youtube_link' => $request->input('youtube_link'),
            'twitter_link' => $request->input('twitter_link'),
            'landline_number' => $request->input('landline_number'),
            'phone' => $request->input('phone'),
            'alternate_phone' => $request->input('alternate_phone'),
            'whatsapp_no' => $request->input('whatsapp_number'),

            'institute_status' => $request->input('institute_status'),
            'establishment' => $request->input('establishment'),
            'total_branches' => $request->input('total_branches'),
            'head_organisation' => $request->input('head_organisation'),
            'tandc' => $request->input('tandc'),
            'about' => $request->input('about'),
            'doubt_and_revision_class' => $request->input('doubt_classes'),
            'batch_strength' => $request->input('batch_strength'),
            'library_facility' => $request->input('library_facility'),
            'topcoachings'     => $request->input('topcoachings'),
            'transport_facility' => $request->input('transport_facility'),
            'boys_hostel' => $request->input('boys_hostel'),
            'girls_hostel' => $request->input('girls_hostel'),
            'total_area' => $request->input('total_area'),
            'institute_management_system' => $request->input('institute_management_system'),
            'modes_of_payment' => $request->input('modes_of_payment'),

            'ac_available' => $request->input('ac_available'),
            'projector_available' => $request->input('projector_available'),
            'biometric_attendence' => $request->input('biometric_attendence'),
            'cctv_with_recording' => $request->input('cctv_with_recording'),
            'audio_system_available' => $request->input('audio_system_available'),

            'study_material' => $request->input('study_material'),
            'scholarship_admission_process' => $request->input('scholarship_admission_process'),
            'class_test' => $request->input('class_test'),
            'online_test' => $request->input('online_test'),
            'offline_test' => $request->input('offline_test'),

            'status' => 'approved'
        ];

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $path = $logo->store('public/coachinglogo');
            $thumb_ext = explode('/', $path);
            $updatearr['logo']  = $thumb_ext[1] . '/' . $thumb_ext[2];
        }

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $path = $thumbnail->store('public/coachingthumbnail');
            $thumb_ext = explode('/', $path);
            $updatearr['thumbnail']  = $thumb_ext[1] . '/' . $thumb_ext[2];
        }


        $coaching = Coaching::create(
            $updatearr
        );

        $remove_aps = str_replace("'", "", $coaching->name);
        $remove_amp = str_replace("&", "", $remove_aps);
        $remove_slash = str_replace("/", "-", $remove_amp);
        $slug = implode('-', explode(' ', strtolower($remove_slash)));
        $cities = OperationArea::whereIn('id', json_decode($coaching->cities))->pluck('name');
        $course = Course::find($request->main_course_id);
        $slug = $slug . '-' . strtolower($cities[0]);
        $slug = $slug . '-' . $course->slug;

        Coaching::find($coaching->id)->update(
            [
                'slug' => $slug
            ]
        );

        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            // $galarr = array();
            if ($request->hasFile('gallery')) {
                foreach ($gallery as $item) {
                    // $img_name = $item->getClientOriginalName();
                    $path = $item->store('public/coachinggallery');
                    $extpath = explode('/', $path);
                    // array_push($galarr,$extpath[1].'/'.$extpath[2]);
                    CoachingGallery::create(
                        [
                            'coaching_id' => $coaching->id,
                            'image' => $extpath[1] . '/' . $extpath[2]
                        ]
                    );
                }
            }
            // $updatearr['gallery'] = json_encode($galarr);
        }

         $wh_data = $request->only([
            'week_days',
            'time_from',
            'time_to'
        ]);

        $this->CoachingWorkingHours($wh_data, $coaching->id);

        $data = $request->only([
            'data_type',
            'result_course',
            'result_exam_year',
            'result_stream',
            'result_type',
            'result_student_name',
            'result_rank',
            'result_percentage',
            // 'selected_in_pt',
            // 'selected_in_mains',
            // 'selected_in_final'
        ]);
        // dd($data);

        $this->addAchivement($data, $coaching->id);

        $result_data = $request->only([
            'rcdata_type',
            'rcresult_course',
            'rcresult_exam_year',
            'rcresult_stream',
            'selected_in_pt',
            'selected_in_mains',
            'selected_in_final',
        ]);


        $this->addResults($result_data, $coaching->id);

        //Add Update Faculty
        $faculty_data = $request->only([
            'faculty_name',
            'faculty_designation',
            'faculty_specialization',
            'faculty_university',
            'faculty_college',
            'faculty_experience'
        ]);

        $this->addFaculty($faculty_data, $coaching->id);

        //Add Fee Structure
        $fee_data = $request->only([
            'fee_course',
            'fee_course_name',
            'fee_duration',
            'fee_stream',
            'fee_process',
            'fee_date',
            'fee_fee',
            'fee_discount'
        ]);

        $this->addFeeStructure($fee_data, $coaching->id);


        return redirect('dashboard/coachings');
    }


      public function approve_Coaching($id){

        // Find the coaching item by ID
        $coaching = Coaching::find($id);
        $coaching->is_verified = 1;
        $coaching->save();
        return back()->with('message', 'verified status updated successfully');

   }
  public function unapprove_Coaching($id){

    // Find the coaching item by ID
    $coaching = Coaching::find($id);
    $coaching->is_verified = 0;
    $coaching->save();
    return back()->with('message', 'verified status removed successfully');

   }


    public function editCoaching($id)
    {
        $coaching   = Coaching::find($id);
        $cities     = OperationArea::all();
        $courses    = Course::all();
        $categories = Category::all();
        $localities = Locality::all();
        $currentCity= json_decode($coaching->cities, true);
        $currentLocalities = Locality::select('id','name','city')->where('city', $currentCity)->get();
        // echo "<pre>"; print_r($localities); die;
        Session::put('redirected_from', $_SERVER['HTTP_REFERER']);
        return view('dashboard.coaching.edit', ['coaching' => $coaching, 'cities' => $cities, 'courses' => $courses, 'categories' => $categories,'localities' => $localities, 'currentLocalities' => (object) $currentLocalities]);
    }

    public function editappliedCoaching($id)
    {
        $coaching   = NewCoaching::find($id);
        $cities     = OperationArea::all();
        $courses    = Course::all();
        $categories = Category::all();
        $localities = Locality::all();

        $currentCity= json_decode($coaching->cities, true);
        $currentLocalities = Locality::select('id','name','city')->where('city', $currentCity)->get();

        // echo "<pre>"; print_r($localities); die;
        Session::put('redirected_from', $_SERVER['HTTP_REFERER']);
        return view('dashboard.coaching.editapplied', ['coaching' => $coaching, 'cities' => $cities, 'courses' => $courses, 'categories' => $categories,'localities' => $localities, 'currentLocalities' => (object) $currentLocalities]);
    }


    public function updateCoaching(Request $request)
    {


        $remove_aps = str_replace("'", "", $request->input('name'));
        $remove_amp = str_replace("&", "", $remove_aps);
        $remove_slash = str_replace("/", "-", $remove_amp);
        $slug = implode('-', explode(' ', strtolower($remove_slash)));
        $cities = OperationArea::whereIn('id', $request->input('cities'))->pluck('name');
        $course = Course::find($request->main_course_id);
        $slug = $slug . '-' . strtolower($cities[0]);
        $slug = $slug . '-' . $course->slug;

        $updatearr =  [
            'name' => $request->input('name'),
            'main_course_id' => $request->main_course_id,
            // 'courses' => json_encode($request->input('courses')),
            'categories' => json_encode($request->input('categories')),
            'cities' => json_encode($request->input('cities')),
            'locality' => json_encode($request->input('locality')),
            'streams' => $request->input('streams'),
            'address' => $request->input('address'),
            'landmark' => $request->input('landmark'),
            'district' => $request->input('district'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
            'pincode' => $request->input('pincode'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),

            'email' => $request->input('email'),
            'website' => $request->input('website'),
            'facebook_link' => $request->input('facebook_link'),
            'youtube_link' => $request->input('youtube_link'),
            'twitter_link' => $request->input('twitter_link'),
            'youtube_video_link' => $request->input('youtube_video_link'),
            'landline_number' => $request->input('landline_number'),
            'phone' => $request->input('phone'),
            'alternate_phone' => $request->input('alternate_phone'),
           'whatsapp_no' => $request->input('whatsapp_number'),

            'institute_status' => $request->input('institute_status'),
            'establishment' => $request->input('establishment'),
            'total_branches' => $request->input('total_branches'),
            'head_organisation' => $request->input('head_organisation'),
            'tandc' => $request->input('tandc'),
            'about' => $request->input('about'),
            'doubt_and_revision_class' => $request->input('doubt_classes'),
            'batch_strength' => $request->input('batch_strength'),
            'library_facility' => $request->input('library_facility'),
            'topcoachings'     => $request->input('topcoachings'),
            'transport_facility' => $request->input('transport_facility'),
            'boys_hostel' => $request->input('boys_hostel'),
            'girls_hostel' => $request->input('girls_hostel'),
            'total_area' => $request->input('total_area'),
            'institute_management_system' => $request->input('institute_management_system'),
            'modes_of_payment' => $request->input('modes_of_payment'),

            'ac_available' => $request->input('ac_available'),
            'projector_available' => $request->input('projector_available'),
            'biometric_attendence' => $request->input('biometric_attendence'),
            'cctv_with_recording' => $request->input('cctv_with_recording'),
            'audio_system_available' => $request->input('audio_system_available'),

            'study_material' => $request->input('study_material'),
            'scholarship_admission_process' => $request->input('scholarship_admission_process'),
            'class_test' => $request->input('class_test'),
            'online_test' => $request->input('online_test'),
            'offline_test' => $request->input('offline_test'),

            'status' => 'approved',

            'slug' => $slug
        ];

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            // $logo_name = $logo->getClientOriginalName();
            $path = $logo->store('public/coachinglogo');
            $thumb_ext = explode('/', $path);
            $updatearr['logo']  = $thumb_ext[1] . '/' . $thumb_ext[2];
        }

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            // $thumbnail_name = $thumbnail->getClientOriginalName();
            $path = $thumbnail->store('public/coachingthumbnail');
            $thumb_ext = explode('/', $path);
            $updatearr['thumbnail']  = $thumb_ext[1] . '/' . $thumb_ext[2];
        }

        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            $galarr = array();
            if ($request->hasFile('gallery')) {
                foreach ($gallery as $item) {
                    $path = $item->store('public/coachinggallery');
                    $extpath = explode('/', $path);
                    $img = $extpath[1] . '/' . $extpath[2];
                    // array_push($galarr,$extpath[1].'/'.$extpath[2]);
                    $check = CoachingGallery::where('coaching_id', $request->id)->where('image', $img)->get();
                    if ($check->count() == 0) {
                        CoachingGallery::create(
                            [
                                'coaching_id' => $request->id,
                                'image' => $img
                            ]
                        );
                    }
                }
            }
            // $updatearr['gallery'] = json_encode($galarr);
        }

        Coaching::find($request->input("id"))->update(
            $updatearr
        );
       $wh_data = $request->only([
            'week_days',
            'time_from',
            'time_to'
        ]);

        $this->CoachingWorkingHours($wh_data, $request->input('id'));

        $data = $request->only([
            'data_type',
            'result_course',
            'result_exam_year',
            'result_stream',
            'result_type',
            'result_student_name',
            'result_rank',
            'result_percentage',
        ]);

        $this->addAchivement($data, $request->input('id'));

        $result_data = $request->only([
            'rcdata_type',
            'rcresult_course',
            'rcresult_exam_year',
            'rcresult_stream',
            'selected_in_pt',
            'selected_in_mains',
            'selected_in_final',
        ]);


        $this->addResults($result_data, $request->input('id'));

        //Add Update Faculty
        $faculty_data = $request->only([
            'faculty_name',
            'faculty_designation',
            'faculty_specialization',
            'faculty_university',
            'faculty_college',
            'faculty_experience'
        ]);

        $this->addFaculty($faculty_data, $request->input('id'));

        //Add Fee Structure
        $fee_data = $request->only([
            'fee_course',
            'fee_course_name',
            'fee_duration',
            'fee_stream',
            'fee_process',
            'fee_date',
            'fee_fee',
            'fee_discount'
        ]);

        $this->addFeeStructure($fee_data, $request->input('id'));

        return redirect(session('redirected_from'))->with('message', 'Coaching updated successfully.');
    }

    public function deleteCoachingGalleryImage($id)
    {
        $img = CoachingGallery::find($id);
        try {
            unlink(public_path('storage') . '/' . $img->image);
        } catch (\Throwable $th) {
        }
        CoachingGallery::find($id)->delete();
        return redirect()->back()->with('message', 'Gallery image deleted successfully');
    }


    public function deleteCoaching($id)
    {
        $coaching = Coaching::find($id);

        if (!in_array(auth()->user()->role, ['admin', 'executive'])) {
            if (auth()->user()->id != $coaching->added_by) {
                return  redirect()->back()->with('message', 'You cannot delete entry of other person. Please contact admin');
            }
        }

        try {
            unlink(public_path('storage') . '/' . $coaching->logo);
            unlink(public_path('storage') . '/' . $coaching->thumbnail);
            foreach (json_decode($coaching->gallery) as $img) {
                unlink(public_path('storage') . '/' . $img);
            }
            foreach (json_decode($coaching->galleries) as $img) {
                unlink(public_path('storage') . '/' . $img->image);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        Coaching::find($id)->delete();
        return redirect()->back()->with('message', 'Coaching deleted successfully.');
    }

    public function deleteappliedCoaching($id)
    {
        $coaching = NewCoaching::find($id);

        if (!in_array(auth()->user()->role, ['admin', 'executive'])) {
            if (auth()->user()->id != $coaching->added_by) {
                return  redirect()->back()->with('message', 'You cannot delete entry of other person. Please contact admin');
            }
        }

        try {
            unlink(public_path('storage') . '/' . $coaching->logo);
            unlink(public_path('storage') . '/' . $coaching->thumbnail);
            foreach (json_decode($coaching->gallery) as $img) {
                unlink(public_path('storage') . '/' . $img);
            }
            foreach (json_decode($coaching->galleries) as $img) {
                unlink(public_path('storage') . '/' . $img->image);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        NewCoaching::find($id)->delete();
        return redirect()->back()->with('message', 'Coaching deleted successfully.');
    }


    //Result
    public function addResults($data, $coaching_id)
    {
        ResultAndAchivement::where('coaching_id', $coaching_id)->where('data_type', 'result')->delete();
        if (!isset($data['rcresult_course']) || count($data['rcresult_course']) == 0) {
            return;
        }
        foreach ($data['rcresult_course'] as $key => $course_id) {
            ResultAndAchivement::create(
                [
                    'data_type' => $data['rcdata_type'][$key],
                    'coaching_id' => $coaching_id,
                    'course_id' => $course_id,
                    'exam_year' => $data['rcresult_exam_year'][$key] ?? "N/A",
                    'stream' => $data['rcresult_stream'][$key],
                    'selected_in_pt' => $data['selected_in_pt'][$key],
                    'selected_in_mains' => $data['selected_in_mains'][$key],
                    'selected_in_final' => $data['selected_in_final'][$key],
                ]
            );
        }
    }

   public function CoachingWorkingHours($data,$coaching_id){
        CoachingWorkingHours::where('coaching_id', $coaching_id)->delete();
        if (!isset($data['week_days']) || count($data['week_days']) == 0 || empty($data['week_days'][0])) {
            return;
        }
        foreach ($data['week_days'] as $key => $value) {
            CoachingWorkingHours::create(
                [
                    'coaching_id' => $coaching_id,
                    'weekdays'    => $data['week_days'][$key],
                    'from'        => $data['time_from'][$key],
                    'to'          => $data['time_to'][$key],
                ]
            );
        }

    }


    public function addAchivement($data, $coaching_id)
    {
        ResultAndAchivement::where('coaching_id', $coaching_id)->where('data_type', 'achivement')->delete();
        if (!isset($data['result_course']) || count($data['result_course']) == 0) {
            return;
        }
        foreach ($data['result_course'] as $key => $course_id) {

            ResultAndAchivement::create(
                [
                    'data_type' => $data['data_type'][$key],
                    'coaching_id' => $coaching_id,
                    'course_id' => $course_id,
                    'exam_year' => $data['result_exam_year'][$key],
                    'stream' => $data['result_stream'][$key],
                    'type' => $data['result_type'][$key],
                    'student_name' => $data['result_student_name'][$key],
                    'rank' => $data['result_rank'][$key],
                    'percentage' => $data['result_percentage'][$key],
                ]
            );
        }
    }




    public function deleteResultAndAchivement(Request $request)
    {
        ResultAndAchivement::where('coaching_id', $request->coaching_id)->where('student_name', $request->student_name)->delete();
        return response()->json(['message' => 'deleted successfully'], 200);
    }

    //Faculty
    public function addFaculty($data, $coaching_id)
    {
        FacultyStaff::where('coaching_id', $coaching_id)->delete();

        foreach ($data['faculty_name'] as $key => $name) {
            // $check_exists = FacultyStaff::where('coaching_id', $coaching_id)->where('name', $name)->where('designation', $data['faculty_designation'][$key])->get();
            // if ($check_exists->count() >= 1) {
            //     FacultyStaff::where('coaching_id', $coaching_id)
            //         ->where('name', $name)
            //         ->where('designation', $data['faculty_designation'][$key])
            //         ->update(
            //             [
            //                 'specialization_on' => $data['faculty_specialization'][$key],
            //                 'university' => $data['faculty_university'][$key],
            //                 'college' => $data['faculty_college'][$key],
            //                 'experience_in_years' => $data['faculty_experience'][$key],
            //             ]
            //         );
            // } else {
            if (!empty($name)){
                FacultyStaff::create(
                    [
                        'coaching_id' => $coaching_id,
                        'name' => $name,
                        'designation' => $data['faculty_designation'][$key],
                        'specialization_on' => $data['faculty_specialization'][$key],
                        'university' => $data['faculty_university'][$key],
                        'college' => $data['faculty_college'][$key],
                        'experience_in_years' => $data['faculty_experience'][$key],
                    ]
                );
            }
        }
    }

    public function deleteFacultyFromCoaching(Request $request)
    {
        FacultyStaff::where('id', $request->faculty_id)
            ->delete();
        return response()->json(['message' => 'deleted successfully'], 200);
    }

    // fee structure
    public function addFeeStructure($data, $coaching_id)
    {
        FeeStructure::where('coaching_id', $coaching_id)->delete();
        if (!isset($data['fee_course']) || count($data['fee_course']) == 0) {
            return;
        }
        foreach ($data['fee_course'] as $key => $course_id) {
            // $check_exists = FeeStructure::where('coaching_id', $coaching_id)->where('course_name', $data['fee_course_name'][$key])->get();
            // if ($check_exists->count() >= 1) {
            //     FeeStructure::where('coaching_id', $coaching_id)
            //         ->where('course_name', $data['fee_course_name'][$key])
            //         ->update(
            //             [
            //                 'course_name' => $data['fee_course_name'][$key],
            //                 'stream' => $data['fee_stream'][$key],
            //                 'admission_process' => $data['fee_process'][$key],
            //                 'batch_starting_date' => $data['fee_date'][$key],
            //                 'course_duration' => $data['fee_duration'][$key],
            //                 'fees' => $data['fee_fee'][$key],
            //                 'scholarship_discount' => $data['fee_discount'][$key],
            //             ]
            //         );
            // } else {
            FeeStructure::create(
                [
                    'coaching_id' => $coaching_id,
                    'course_id' => $course_id,
                    'course_name' => $data['fee_course_name'][$key],
                    'stream' => $data['fee_stream'][$key],
                    'admission_process' => $data['fee_process'][$key],
                    'batch_starting_date' => $data['fee_date'][$key],
                    'course_duration' => $data['fee_duration'][$key],
                    'fees' => $data['fee_fee'][$key],
                    'scholarship_discount' => $data['fee_discount'][$key],
                ]
            );
            // }
        }
    }

    public function deleteFeeStructure(Request $request)
    {
        FeeStructure::where('id', $request->fee_id)->delete();
        return response()->json(['message' => 'deleted successfully'], 200);
    }

    public function enrollments($id){
        $enrollments = StudentRegistrationDetail::where('coaching_id',$id)->orderBy('id', 'desc')->paginate(25);
        return view('dashboard.coaching.enrollments',['enrollments'=>$enrollments]);
    }
}
