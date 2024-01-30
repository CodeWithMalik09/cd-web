<?php

namespace App\Http\Controllers\api\app\coaching;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coaching;
use App\Models\Course;
use App\Models\FacultyStaff;
use App\Models\FeeStructure;
use App\Models\OperationArea;
use App\Models\ResultAndAchivement;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class AppCoachingController extends Controller
{
    public function searchFetch()
    {
        $categories = Category::select(['id', 'name'])->get();
        $courses = Course::select(['id', 'name'])->get();
        $cities =  OperationArea::select(['id', 'name'])->get();
        return response()->json(['message' => 'success', 'categories' => $categories, 'courses' => $courses, 'cities' => $cities], 200);
    }


    public function coachingsWithLessDetails(Request $request)
    {
        $courses = Course::orderBy('name', 'asc')->get();

        $cities = OperationArea::orderBy('name', 'asc')->get();
        // $coachings = Coaching::orderBy('id', 'DESC')->limit(6)->get();
        foreach ($courses as $course) {
            $coachngs = Coaching::where('main_course_id',  $course->id)->where('status', 'approved')->limit(6)->orderBy('id', 'desc')->get();

            foreach ($coachngs as $coaching) {
                $coaching->{'logo'} = url('storage') . '/' . $coaching->logo;
                // $coaching->{'rating'} = $coaching->stats->average_rating ?? 0;
                // $coaching->{'likes'} =  $coaching->stats->likes ?? 0;
                // $coaching->{'dislikes'} = $coaching->stats->dislikes ?? 0;
                // $coaching->{'course'} = $coaching->mainCourse->name;
                // $wishlist =  Wishlist::where(
                //     [
                //         ['user_id', '=', auth()->user()->id],
                //         ['wish_id', '=', $coaching->id]
                //     ]
                // )->get()->count();
                // if ($wishlist >= 1) {
                //     $coaching->{'wishlisted'} = true;
                // } else {
                //     $coaching->{'wishlisted'} = false;
                // }
            }

            $course->{'coachings'} = $coachngs;
        }

        // $data = [
        //     // 'label_courses' => $label_wise_courses,
        //     'cities' => $cities,
        //     'coachings' => $coachings,
        //     'courses' => $courses
        // ];

        return response()->json(['message' => 'success', 'course_coachings' => $courses], 200);
    }

    public function coachings(Request $request)
    {
        $coachings = Coaching::orderBy("id", "DESC")->offset(10 * $request->input('offset'))->where('status', 'approved')->limit(10)->get();
        foreach ($coachings as $coaching) {
            $coaching->{'logo'} = url('storage') . '/' . $coaching->logo;
            $coaching->{'rating'} = $coaching->stats->average_rating ?? 0;
            $coaching->{'likes'} =  $coaching->stats->likes ?? 0;
            $coaching->{'dislikes'} = $coaching->stats->dislikes ?? 0;
            $coaching->{'course'} = $coaching->mainCourse->name;
            $wishlist =  Wishlist::where(
                [
                    ['user_id', '=', auth()->user()->id],
                    ['wish_id', '=', $coaching->id]
                ]
            )->get()->count();
            if ($wishlist >= 1) {
                $coaching->{'wishlisted'} = true;
            } else {
                $coaching->{'wishlisted'} = false;
            }
        }
        return response()->json(['message' => 'success', 'coachings' => $coachings], 200);
    }

    public function coaching(Request $request)
    {
        $coaching = Coaching::where('id', $request->input('coaching_id'))->get()->first();
        $gallery = array();
        if ($coaching->galleries) {
            foreach ($coaching->galleries as $gallery_item) {
                array_push($gallery, url('storage') . '/' . $gallery_item->image);
            }
        }
        $coaching->{'pgallery'} = $gallery;
        $course = Course::select(['name'])->where('id', $coaching->main_course_id)->first();

        unset($coaching->gallery);
        $categories = Category::select(['name'])->whereIn('id', json_decode($coaching->categories))->get();
        $categories_str = "";
        foreach ($categories as $category) {
            $categories_str .= $category->name . ", ";
        }

        $coaching->{'stats'} = $coaching->stats;
        $coaching->{'reviews'} = $coaching->reviews;
        $coaching->{'courses'} = $course->name;
        $coaching->{'categories'} = $categories_str;
        $coaching->{'logo'} = url('storage') . '/' . $coaching->logo;
        $coaching->{'fee_structures'} = $coaching->feeStructures;
        $sno = 1;
        foreach ($coaching->fee_structures as $structure) {
            $structure->{'sno'} = $sno;
            $structure->{'course_name'} = $structure->course['name'];
            unset($structure->course);
            $sno += 1;
        }
        $coaching->{'results_and_achivements'} = $coaching->resultsAndAchivements;
        foreach ($coaching->results_and_achivements as $result) {
            $result->{'course_name'} = $result->course['name'];
            unset($result->course);
        }
        return response()->json(["message" => "success", "coaching" => $coaching], 200);
    }

    public function searchCoaching(Request $request)
    {
        $coachings = Coaching::orderBy("id", "DESC")
            ->where('status', 'approved')
            ->where('main_course_id', $request->course_id)
            ->where('cities', 'like', '%\"' . $request->city_id . '\"%')
            ->where('categories', 'like', '%' . $request->category_id . '%')
            ->get();

        foreach ($coachings as $coaching) {
            $coaching->{'logo'} = url('storage') . '/' . $coaching->logo;
            $coaching->{'rating'} = $coaching->stats->average_rating ?? 0;
            $coaching->{'likes'} =  $coaching->stats->likes;
            $coaching->{'dislikes'} = $coaching->stats->dislikes;
            $coaching->{'course'} = $coaching->mainCourse->name;
            $wishlist =  Wishlist::where(
                [
                    ['user_id', '=', auth()->user()->id],
                    ['wish_id', '=', $coaching->id]
                ]
            )->get()->count();
            if ($wishlist >= 1) {
                $coaching->{'wishlisted'} = true;
            } else {
                $coaching->{'wishlisted'} = false;
            }
        }
        return response()->json(['message' => 'success', 'coachings' => $coachings], 200);
    }


    public function mapSearchCoaching(Request $request)
    {
        $coachings = Coaching::orderBy("id", "DESC")
            ->offset(10 * $request->input('offset'))
            ->where('status', 'approved')
            ->where('main_course_id', $request->course_id)
            ->where('cities', 'like', '%\"' . $request->city_id . '\"%')
            ->where('categories', 'like', '%' . $request->category_id . '%')
            ->where('latitude', '<>', null)
            ->where('longitude', '<>', null)
            ->select(['id', 'latitude', 'longitude'])
            ->limit(10)
            ->get();


        return response()->json(['message' => 'success', 'coachings' => $coachings], 200);
    }

    public function feeStructure(Request $request)
    {
        $fee_structures = FeeStructure::where('coaching_id', $request->input('coaching_id'))->get();
        $sno = 1;
        foreach ($fee_structures as $structure) {
            $structure->{'sno'} = $sno;
            $structure->{'course_name'} = $structure->course['name'];
            unset($structure->course);
            $sno += 1;
        }
        return response()->json(['message' => 'success', 'fee_structures' => $fee_structures], 200);
    }

    public function resultsAndAchivements(Request $request)
    {
        $results = ResultAndAchivement::where('coaching_id', $request->input('coaching_id'))->get();
        foreach ($results as $result) {
            $result->{'course_name'} = $result->course['name'];
            unset($result->course);
        }
        return response()->json(['message' => 'success', 'results' => $results], 200);
    }

    public function faculties(Request $request)
    {
        $faculties = FacultyStaff::where('coaching_id', $request->input('coaching_id'))->get();
        return response()->json(['message' => 'success', 'faculties' => $faculties], 200);
    }
}
