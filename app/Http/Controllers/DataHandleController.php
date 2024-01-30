<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Coaching;
use App\Models\CoachingGallery;
use App\Models\CoachingStatistics;
use App\Models\Course;
use App\Models\OperationArea;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataHandleController extends Controller
{
    public function addslug()
    {
        $courses = Course::all();
        foreach ($courses as $course) {
            $slug = urlencode(str_replace(",", "", str_replace("&", "", str_replace(" ", "-", str_replace("/", "-", str_replace(")", "", str_replace("(", "", strtolower($course->name))))))));
            Course::find($course->id)->update(
                [
                    'slug' => $slug,
                ]
            );
        }
        return "done";
    }

    public function moveGallery()
    {
        $coachings = Coaching::all();

        foreach ($coachings as $key => $coaching) {
            if ($coaching->gallery) {
                foreach (json_decode($coaching->gallery) as $key => $image) {
                    $check = CoachingGallery::where('coaching_id', $coaching->id)->where('image', $image)->get();
                    if ($check->count() == 0) {
                        CoachingGallery::create(
                            [
                                'coaching_id' => $coaching->id,
                                'image' => $image
                            ]
                        );
                    }
                }
            }
        }

        dd('process completed');
    }

    public function generateCoachingSlug()
    {
        $coachings = Coaching::all();
        foreach ($coachings as $key => $coaching) {
            $remove_aps = str_replace("'", "", $coaching->name);
            $remove_amp = str_replace("&", "", $remove_aps);
            $slug = implode('-', explode(' ', strtolower($remove_amp)));
            $cities = OperationArea::whereIn('id', json_decode($coaching->cities))->pluck('name');
            $slug = $slug . '-' . strtolower($cities[0]);

            Coaching::find($coaching->id)->update(
                [
                    'slug' => $slug
                ]
            );
        }
        dd("Process Completed");
    }

    public function convertCitiesArrayToId()
    {
        $coachings = Coaching::all();
        foreach ($coachings as $key => $coaching) {
            // $cities = json_decode($coaching->cities); 
            // dd(gettype($coaching->cities)); 
            if (gettype($coaching->cities) == "string") {
                Coaching::find($coaching->id)->update(
                    [
                        'cities' => json_encode([$coaching->cities])
                    ]
                );
            }

            Log::info("cities converted:  " . $coaching->id);
        }
    }

    public function generateBlogSlugs()
    {
        $blogs = Blog::all();

        foreach ($blogs as $key => $blog) {
            $slug = implode('-', explode(' ', strtolower($blog->heading)));
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
            $blog->slug = $slug;
            $blog->save();
        }

        return "blog slug genereated";
    }

    public function convertJobCourseToArray()
    {
        $jobs = Blog::where('category', 'job')->get();

        foreach ($jobs as $key => $job) {
            $array = array();

            $decodedData = json_decode($job->course);

            if ($decodedData === null && json_last_error() !== JSON_ERROR_NONE) {
                array_push($array, $job->course);

                Blog::find($job->id)->update(
                    [
                        'course' => json_encode($array)
                    ]
                );
            }
        }
    }

    public function manipulateLikesAndDislikes()
    {
        $coachings = Coaching::all();
        foreach ($coachings as $key => $coaching) {
            if ($coaching->status == "approved") {
                $count = CoachingStatistics::where('coaching_id', $coaching->id)->count();
                if ($count == 1) {
                    CoachingStatistics::where('coaching_id', $coaching->id)->update(
                        [
                            'likes' => rand(10, 25),
                            'dislikes' => rand(0, 10),
                            'average_rating' => rand(30, 50) / 10,
                        ]
                    );
                } else {
                    CoachingStatistics::create(
                        [
                            'coaching_id' => $coaching->id,
                            'views' => 0,
                            'likes' => rand(10, 25),
                            'dislikes' => rand(0, 10),
                            'enrollments' => 0,
                            'shares' => 0,
                            'compares' => 0,
                            'average_rating' => rand(30, 50) / 10,
                        ]
                    );
                }
            }
        }

        return response()->json(['status' => 'success'], 200);
    }


    public function replaceCoachingThumbnail()
    {
        $coachings = Coaching::all();

        // dd($coachings->count());
        foreach ($coachings as $key => $coaching) {
            try {
                unlink(public_path('storage') . '/' . $coaching->thumbnail);
            } catch (\Throwable $th) {
                //throw $th;
            }
            Coaching::find($coaching->id)->update(
                [
                    'thumbnail' => "coachingthumbnail/default_thumbnail.jpeg"
                ]
            );
            // $coaching->thumbnail = "coachingthumbnail/default_thumbnail.jpeg";
            // $coaching->save();
        }
    }
}
