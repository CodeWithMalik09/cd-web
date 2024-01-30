<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JobController extends Controller
{
    public function index()
    {
     $courses=Course::all();
        $last_visible_date = date('Y-m-d', strtotime(date('Y-m-d'). ' - 4 days'));
         $blogs = Blog::where('category', 'job')
          ->where(function ($query) use ($last_visible_date) { $query->where('job_last_date', '>', $last_visible_date) ->orWhere('job_last_date', '=', NULL); })
        
        ->orderBy('id', 'desc')
        ->paginate(9);
        return view('blog', ['blogs' => $blogs, 'type' => 'Job','courses'=>$courses]);
    }

    public function item($id)
    {
        Blog::where('slug', $id)->increment('views');
        $blog = Blog::where('slug', $id)->get()->first();
        if ($blog) {
            $related_blogs = Blog::where('id', '<>', $id)->where('category', 'job')->where('course', $blog->course)->orderBy('id', 'desc')->limit(30)->get();
            return view('blogview', ['blog' => $blog, 'relatedblogs' => $related_blogs, 'type' => implode(",", array_unique(json_decode($blog->course, true)))]);
        }else{
            return view('static.notFound', ['message' => "Oops! no any blog found."]);
        }
    }

    public function search(Request $request)
    {
        $course = '';
        $last_visible_date = date('Y-m-d', strtotime(date('Y-m-d'). ' - 4 days'));
        if ($request->has('course')) {
            $course = $request->course;
            Session::put('job-search-course', $request->course);
        } else if (!$request->has('course') && session('job-search-course') !== null) {
            $course = session('job-search-course');
        }

        $blogs = Blog::where('category', 'job');

      //  ->where(function($query) use ($last_visible_date){  $query->where('job_last_date','>',$last_visible_date)->orWhere('job_last_date','=',NULL);});
        
           
        

        if ($course != '') {
            $blogs->where('course', 'LIKE', "%" . str_replace('/', '-', $course) . "%");
        }


        $blogs = $blogs->orderBy('id', 'desc')
            ->paginate(9);
        return view('blog', ['blogs' => $blogs, 'type' => 'Job', 'search' => $course]);
    }
}
