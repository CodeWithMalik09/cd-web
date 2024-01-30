<?php

namespace App\Http\Controllers;

use App\Models\Coaching;
use App\Models\CoachingGallery;
use App\Models\Course;
use App\Models\NewCoachingGallery;
use App\Models\OperationArea;
use App\Models\Otp;
use App\Models\NewCoachingsCourseCategory;
use App\Models\NewWorkingHours;
use App\Models\NewAchievement;
use App\Models\NewFacultyStaff;
use App\Models\NewResult;
use App\Models\NewFeeStructure;
use App\traits\SendSMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use App\Models\NewCoaching;
use App\Models\NewOtp;

class CoachingRegistrationController extends Controller
{

    use SendSMS;

    public function coachingregistration()
    {
        return view('coachingregistration.register');
    }

    public function createCoaching(Request $request)
    {
        $exsisting_email  = NewCoaching::where('email', $request->input('email'))->get();
        $exsisting_phone  = NewCoaching::where('phone', $request->input('phone'))->get();

        if ($exsisting_email->count() == 1) {
            return redirect()->back()->with('message', 'Email already exists');
        } else if ($exsisting_phone->count() == 1) {
            return redirect()->back()->with('message', 'Phone number already exists');
        } else {
            $coaching = NewCoaching::create(
                [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'password' => md5($request->input('password'))
                ]
            );

            $otp = rand(1000, 9999);

            Otp::create(
                [
                    'role' => 'coaching',
                    'role_id' => $coaching->id,
                    'otp' => $otp,
                ]
            );

            $this->SendOtpToNumber($request->phone, $otp);

            Session::put('verification_details', array('type' => 'coaching', 'phone' => Crypt::encrypt($request->input('phone'))));
            return redirect('verification');
            // with('message',['type'=>'coaching','email'=>Crypt::encrypt($request->input('email'))]);
        }
    }

    public function verification(Request $request)
    {

    }

    public function stepTwoSubmit(Request $request)
    {
        //echo "<pre>"; print_r($request->all()); die;
        $data =  [
            'main_course_id' => $request->input('course'),

            'cities' => json_encode([$request->input('city') . ""]),
            'locality' => json_encode($request->input('locality')),
            'address' => $request->input('address'),
            'landmark' => $request->input('landmark'),
            'district' => $request->input('district'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
            'pincode' => $request->input('pincode'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),

            'website' => $request->input('website'),
            'facebook_link' => $request->input('facebook_link'),
            'youtube_link' => $request->input('youtube_link'),
            'twitter_link' => $request->input('twitter_link'),
            'landline_number' => $request->input('landline_number'),
            // 'phone' => $request->input('phone'),
            'alternate_phone' => $request->input('alternate_phone'),

            'institute_status' => $request->input('institute_status'),
            'establishment' => $request->input('establishment'),
            'total_branches' => $request->input('total_branches'),
            'head_organisation' => $request->input('head_organisation'),
            'about' => $request->input('about'),
            'doubt_and_revision_class' => $request->input('doubt_classes'),
            'batch_strength' => $request->input('batch_strength'),
            'library_facility' => $request->input('library_facility'),
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
        ];

        $coaching = NewCoaching::where('phone', Crypt::decrypt(session('verification_details')['phone']))->first();

        $remove_aps = str_replace("'", "", $coaching->name);
        $remove_amp = str_replace("&", "", $remove_aps);
        $remove_slash = str_replace("/", "-", $remove_amp);
        $slug = implode('-', explode(' ', strtolower($remove_slash)));
        $cities = OperationArea::whereIn('id', [$request->input('city')])->pluck('name');
        $course = Course::find($request->course);
        $slug = $slug . '-' . strtolower($cities[0]);
        // $slug = $slug . '-' . $course->slug;

        // if (NewCoaching::where('slug', $slug)->count() > 0) {
        //     return redirect()->back()->with('message', 'Coaching already exists');
        // }

        $data['slug'] = $slug;

        // dd($data);


        NewCoaching::where('phone', Crypt::decrypt(session('verification_details')['phone']))->update(
            $data
        );
        $category_data = $request->only([
            'courseCategory'

        ]);

        $this->addCategories($category_data, $coaching->id);
        $working_hours = $request->only([
            'weekdays',
            'from',
            'to'

        ]);

        $this->addWorkingHours($working_hours, $coaching->id);
        $new_achievement = $request->only([

        'achievementcourse',
        'type',
        'exam_year',
        'stream',
        'student_name',
        'Rank',
        'Score',

        ]);

        $this->addNewAchievement($new_achievement, $coaching->id);

        $new_result = $request->only([

            'resultcourse',
            'resultexam_year',
            'resultstream',
            'resultpt_select',
            'resultmain_select',
            'resultfinal_select',

            ]);

            $this->addNewResult($new_result, $coaching->id);


        $new_faculty = $request->only([

            'f_name',

            'f_designation',
            'f_specialisation',
            'f_university',
            'f_college',
            'f_experience',

            ]);

            $this->addNewFaculty($new_faculty, $coaching->id);

        $new_fee = $request->only([

            'fee_course',
            'course_name',
            'fee_stream',
            'fees',
            'batch_start_date',
            'course_duration',
            'admission_process',
            'discount',

            ]);

            $this->addNewFeeStructure($new_fee, $coaching->id);


        return view('coachingregistration.gallery');
    }
    public function addCategories($data,$coaching_id){
        NewCoachingsCourseCategory::where('coaching_id', $coaching_id)->delete();
        foreach ($data['courseCategory'] as $key => $value) {
            NewCoachingsCourseCategory::create(
                [
                    'coaching_id' => $coaching_id,
                    'category'    => json_encode($value['categories']),
                    'course'      => json_encode($value['course']),
                ]
            );
        }
    }
    public function addWorkingHours($data,$coaching_id){
        NewWorkingHours::where('coaching_id', $coaching_id)->delete();

        foreach ($data['weekdays'] as $key => $value) {
            NewWorkingHours::create(
                [
                    'coaching_id' => $coaching_id,
                    'weekdays'      => $data['weekdays'][$key],
                    'from'      => $data['from'][$key],
                    'to'      => $data['to'][$key],
                ]
            );
        }

    }
      public function  addNewAchievement($data,$coaching_id){

        NewAchievement::where('coaching_id', $coaching_id)->delete();
     

        foreach ($data['achievementcourse'] as $key => $value) {
            NewAchievement::create(
                [
                    'coaching_id'  => $coaching_id,
                    'course'       => $data['achievementcourse'][$key],
                    'type'         => $data['type'][$key],
                    'exam_year'    => $data['exam_year'][$key],
                    'stream'       => $data['stream'][$key],
                    'student_name' => $data['student_name'][$key],
                    'Rank'         => $data['Rank'][$key],
                    'Score'        => $data['Score'][$key],
                ]
            );
        }


      }

    public function addNewResult($data,$coaching_id){
        NewResult::where('coaching_id', $coaching_id)->delete();
        foreach ($data['resultcourse'] as $key => $value) {
            NewResult::create(
                [
                    'coaching_id'               => $coaching_id,
                    'course'                    => $data['resultcourse'][$key],
                    'exam_year'                 => $data['resultexam_year'][$key],
                    'stream'                    => $data['resultstream'][$key],
                    'selected_pt_students'      => $data['resultpt_select'][$key],
                    'selected_mains_students'   => $data['resultmain_select'][$key],
                    'selected_final_students'   => $data['resultfinal_select'][$key],
                ]
            );
        }
    }

    public function addNewFaculty($data,$coaching_id){
        NewFacultyStaff::where('coaching_id', $coaching_id)->delete();
        foreach ($data['f_name'] as $key => $value) {
            NewFacultyStaff::create(
                [
                    'coaching_id'          => $coaching_id,
                    'name'                => $data['f_name'][$key],
                    'designation'         => $data['f_designation'][$key],
                    'specialisation'      => $data['f_specialisation'][$key],
                    'university'          => $data['f_university'][$key],
                    'college'             => $data['f_college'][$key],
                    'experience_in_years' => $data['f_experience'][$key],
                ]
            );
        }
    }

    public function addNewFeeStructure($data, $coaching_id){

        NewFeeStructure::where('coaching_id', $coaching_id)->delete();
        foreach ($data['fee_course'] as $key => $value) {
            NewFeeStructure::create(
                [
                    'coaching_id'            => $coaching_id,
                    'course'                 => $data['fee_course'][$key],
                    'course_name'            => $data['course_name'][$key],
                    'stream'                 => $data['fee_stream'][$key],
                    'admission_process'      => $data['admission_process'][$key],
                    'batch_starting_date'    => $data['batch_start_date'][$key],
                    'fees'                   => $data['fees'][$key],
                    'scholarship_discount'   => $data['discount'][$key],
                ]
            );
        }
    }

    public function addgallery(Request $request)
    {

        $updatearr = [];

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo_name = $logo->getClientOriginalName();
            $path = $logo->storeAs('public/coachinglogo', $logo_name);
            $thumb_ext = explode('/', $path);
            $updatearr['logo']  = $thumb_ext[1] . '/' . $thumb_ext[2];
        }

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->getClientOriginalName();
            $path = $thumbnail->storeAs('public/coachingthumbnail', $thumbnail_name);
            $thumb_ext = explode('/', $path);
            $updatearr['thumbnail']  = $thumb_ext[1] . '/' . $thumb_ext[2];
        }


        $coaching =  NewCoaching::where('phone', Crypt::decrypt(session('verification_details')['phone']))->first();

        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            foreach ($gallery as $item) {
                // $img_name = $item->getClientOriginalName();
                $path = $item->store('public/coachinggallery');
                $extpath = explode('/', $path);
                // array_push($galarr,$extpath[1].'/'.$extpath[2]);
                NewCoachingGallery::create(
                    [
                        'coaching_id' => $coaching->id,
                        'image' => $extpath[1] . '/' . $extpath[2]
                    ]
                );
            }
        }

        NewCoaching::where('phone', Crypt::decrypt(session('verification_details')['phone']))->update(
            $updatearr
        );

        return view('coachingregistration.confirm');
    }
}
