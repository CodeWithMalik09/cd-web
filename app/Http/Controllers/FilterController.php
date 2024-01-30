<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coaching;
use App\Models\Course;
use App\Models\OperationArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    public function coachingFilter(Request $request)
    {

        $url_split = explode("/", $request->url);
        if (count($url_split) == 5) {
            $course_slug = $url_split[4];
        } else {
            $course_slug = $url_split[5];
            $city = $url_split[6];
            $type = $url_split[4];
        }

        $course = Course::where('slug', $course_slug)->first();
        $coachings =  Coaching::leftjoin('coaching_statistics as cst', function ($join) {
            $join->on('cst.coaching_id', 'coachings.id');
        })

            ->where('is_active', true)
            ->where('is_deleted', false)
            ->select(
                'coachings.name',
                'coachings.logo',
                'coachings.id',
                'coachings.slug',
                'coachings.establishment',
                'coachings.head_organisation',
                'coachings.main_course_id',
                'coachings.total_branches',
                'coachings.email',
                'coachings.phone',
                'coachings.address',
                'coachings.state',
                'coachings.country',
                'coachings.pincode',
                'cst.views',
                'cst.likes',
                'cst.dislikes',
                'cst.average_rating'
            );

        if (isset($type)) {
            $category = Category::where('slug', $type)->first();
            $coachings->where('categories', 'like', '%' . "\"" . $category->id . "\"" . '%');
        }

        if (isset($city)) {
            $operation_area = OperationArea::where('name', 'like', '%' . $city . '%')->first();
            $coachings->where('cities', 'like', '%' . "\"" . $operation_area->id . "\"" . '%');
        }

        if ($course) {
            $coachings->where('main_course_id', $course->id);
        }

        if ($request->has('established')) {
            $coachings->orderBy('coachings.establishment', $request->established);
        }

        if ($request->has('branches')) {
            $coachings->orderBy('coachings.total_branches', $request->branches);
        }

        if ($request->has('selected_citylocals')) {
            $coachings->where('locality', 'like', '%' . "\"" . $request->selected_citylocals . "\"" . '%');
        }


        if ($request->has('views')) {
            $coachings->orderBy('cst.views', $request->views);
        }

        if ($request->has('likes')) {
            $coachings->orderBy('cst.likes', $request->likes);
        }

        if ($request->has('dislikes')) {
            $coachings->orderBy('cst.dislikes', $request->dislikes);
        }

        if($request->has('rating')){
            $coachings->where('cst.average_rating', '>=',$request->rating);

        }


        $coachings = $coachings->limit(15)->get();

        foreach ($coachings as $coaching) {
            // $coaching->{'encrypted_id'} = Crypt::encrypt($coaching->id);
            $coaching->{'localval'} = str_replace('"', '\"', json_encode($coaching->only(['id', 'name', 'logo'])));
            // $coaching->{'url'} = url('coaching') . '/' . implode('-', explode(' ', $coaching->name));
            $coaching->{'courses'} = DB::table('courses')->where('id',$coaching->main_course_id)->select('name')->get()->pluck('name');
        }

        $is_session_set = false;
        if (session('user')) {
            $is_session_set = true;
        }

        return response()->json(['coachings' => $coachings, 'is_session_set' => $is_session_set], 200);
    }

    public function tutorFilter(Request $request)
    {
    }
}
