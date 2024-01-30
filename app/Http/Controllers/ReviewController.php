<?php

namespace App\Http\Controllers;

use App\Models\Coaching;
use App\Models\CoachingStatistics;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function writeReview($coaching_slug)
    {
        $coaching = Coaching::where('slug', $coaching_slug)->first();
        return view('writeReview', ['coaching' => $coaching]);
    }

    public function storeReview(Request $request)
    {
        $coaching_id =  base64_decode($request->rate);
        if(Review::where('user_id',auth()->user()->id)->where('coaching_id',$coaching_id)->count() >= 1){
            return redirect()->back()->with('message','You have already reviewed this coaching.');
        }

        $overall_rating = ($request->rate_faculties + $request->rate_fees + $request->rate_study_materials + $request->rate_results) / 4;
        Review::create(
            [
                'user_id' => auth()->user()->id,
                'coaching_id' => $coaching_id,
                'review' => $request->review,
                'stars_faculties' => $request->rate_faculties,
                'stars_fees' => $request->rate_fees,
                'stars_study_materials' => $request->rate_study_materials,
                'stars_results' => $request->rate_results,
                'overall_rating' => round($overall_rating, 1)
            ]
        );

        CoachingStatistics::where('coaching_id', $coaching_id)->update(
            [
                'average_rating' => round($overall_rating,1)
            ]
        );

        $coaching = Coaching::find($coaching_id);
        return redirect("coaching/$coaching->slug")->with('message', 'Your review submitted successfully.');
    }
}
