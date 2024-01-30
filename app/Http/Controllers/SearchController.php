<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coaching;
use App\Models\Course;
use App\Models\OperationArea;
use App\Models\Wishlist;
use App\Models\Locality;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function course($slug)
    {
        $course = Course::where('slug', $slug)->get()->first();
        $localities=Locality::all();
        if (!$course) {
            return view('static.notFound', ['message' => "Currently no any coaching in this course. We will update it soon."]);
        }
        $coachings = Coaching::where('main_course_id', $course->id)->orderBy('id', 'desc')->paginate(25);
        foreach ($coachings as $key => $coaching) {
            if (auth()->user()) {
                $wishlist =  Wishlist::where(
                    [
                        ['user_id', '=', auth()->user()->id],
                        ['wish_id', '=', $coaching->id]
                    ]
                )->count();
                if ($wishlist >= 1) {
                    $coaching->{'wishlisted'} = true;
                } else {
                    $coaching->{'wishlisted'} = false;
                }
            } else {
                $coaching->{'wishlisted'} = false;
            }
        }
        return view('coachinglist', ['coachings' => $coachings, 'courses' => Course::all(), 'cities' => OperationArea::all(), 'coursename' => $course->name, 'course' => $course,'localities' => $localities]);
    }


   public function topcoachings($slug)
    {
        $course = Course::where('slug', $slug)->get()->first();
        $localities=Locality::all();
        if (!$course) {
            return view('static.notFound', ['message' => "Currently no any coaching in this course. We will update it soon."]);
        }
        $coachings = Coaching::where('main_course_id', $course->id)->where('topcoachings',1)->orderBy('id', 'desc')->paginate(25);
        foreach ($coachings as $key => $coaching) {
            if (auth()->user()) {
                $wishlist =  Wishlist::where(
                    [
                        ['user_id', '=', auth()->user()->id],
                        ['wish_id', '=', $coaching->id]
                    ]
                )->count();
                if ($wishlist >= 1) {
                    $coaching->{'wishlisted'} = true;
                } else {
                    $coaching->{'wishlisted'} = false;
                }
            } else {
                $coaching->{'wishlisted'} = false;
            }
        }
        return view('coachinglist', ['coachings' => $coachings, 'courses' => Course::all(), 'cities' => OperationArea::all(), 'coursename' => $course->name, 'course' => $course,'localities' => $localities]);
    }


    public  function searchByCoachingName($text)
    {
        $coachings = Coaching::where('name', 'like', '%' . $text . '%')->paginate(25);
        $localities=Locality::all();
        return view('coachinglist', ['coachings' => $coachings, 'courses' => Course::all(), 'cities' => OperationArea::all(), 'searchtext' => $text, 'localities' => $localities]);
    }

    public  function searchByCoachingNameCity($text,$city)
    {
        $localities=Locality::all();
        $city = OperationArea::select(['id', 'name'])->where('name', 'like', "%" . $city . "%")->first();
        $coachings = Coaching::where('name', 'like', '%' . $text . '%')->where('cities', 'LIKE', '%\"' . $city->id . '\"%')->paginate(25);
        return view('coachinglist', ['coachings' => $coachings, 'courses' => Course::all(), 'cities' => OperationArea::all(), 'searchtext' => $text, 'localities' => $localities]);
    }
}
