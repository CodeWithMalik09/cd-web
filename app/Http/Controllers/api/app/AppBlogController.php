<?php

namespace App\Http\Controllers\api\app;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class AppBlogController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $blogs = Blog::where('category', $request->category)->offset(10 * $request->input('offset'))->orderBy('id', 'desc')->limit(10)->get();
        foreach ($blogs as $key => $blog) {
            $blog->{'date'} = date('d F Y', strtotime($blog->created_at));
            $blog->{'author_name'} = "CoachingDetail";
            $blog->{'author_image'} = asset('assets/logo.jpeg');
            $blog->{'thumbnail'} = url('storage') . '/' . $blog->thumbnail;
            $blog->{'share_link'} = url("$blog->category/$blog->slug");
            $blog->{'excerpt'} =  str_replace('&amp;', '', str_replace(':&nbsp;', '', substr(strip_tags($blog->content), 0, 240)));
        }

        $data['blogs'] = $blogs;

        if ($request->category == "job") {
            $courses = [
                'All India Govt. Jobs',
                'Bank Jobs',
                'Teaching Jobs',
                'Technical Jobs(GATE/ESE/State PSUs)',
                'Technical Jobs(Upto JE)',
                'Railway Jobs',
                'SSC Jobs',
                'UPSC Jobs',
                'Police/Defence Jobs',
                'Andhra Pradesh Jobs',
                'Arunachal Pradesh Jobs',
                'Assam Jobs', 'Bihar Jobs',
                'Chhattisgarh Jobs',
                'Delhi Jobs',
                'Gujarat Jobs',
                'Himachal Jobs',
                'Haryana Jobs',
                'Jharkhand Jobs',
                'Karnataka Jobs',
                'Kerala Jobs',
                'Maharastra Jobs',
                'Madhya Pradesh Jobs',
                'Odisha Jobs',
                'Punjab Jobs',
                'Rajasthan Jobs',
                'Tamil Nadu Jobs',
                'Telangana Jobs',
                'Uttarakhand Jobs',
                'Uttar Pradesh Jobs',
                'West Bengal Jobs'
            ];

            $data['courses'] = $courses;
        }

        return response()->json($data, 200);
    }

    public function blog(Request $request)
    {
        $blog = Blog::find($request->blog_id);
        $blog->{'date'} = date('d F Y', strtotime($blog->created_at));
        $blog->{'author_name'} = "CoachingDetail";
        $blog->{'author_image'} = asset('assets/logo.jpeg');
        $blog->{'thumbnail'} = url('storage') . '/' . $blog->thumbnail;
        $blog->{'share_link'} = url("$blog->category/$blog->slug");
        $blog->{'tts_content'} =  str_replace('&amp;', '', str_replace(':&nbsp;', '', strip_tags($blog->content)));
        return response()->json($blog, 200);
    }


    public function search(Request $request)
    {
        $blogs = Blog::where('category', 'job')
            ->offset(10 * $request->input('offset'));
        $blogs->where('course', 'LIKE', "%" . str_replace('/', '-', $request->course) . "%");
        $blogs = $blogs->orderBy('id', 'desc')->limit(10)->get();

        foreach ($blogs as $key => $blog) {
            $blog->{'date'} = date('d F Y', strtotime($blog->created_at));
            $blog->{'author_name'} = "CoachingDetail";
            $blog->{'author_image'} = asset('assets/logo.jpeg');
            $blog->{'thumbnail'} = url('storage') . '/' . $blog->thumbnail;
            $blog->{'share_link'} = url("$blog->category/$blog->slug");
            $blog->{'excerpt'} =  str_replace('&amp;', '', str_replace(':&nbsp;', '', substr(strip_tags($blog->content), 0, 240)));
        }

        return response()->json(['blogs' => $blogs, 'category' => 'Job'], 200);
    }
}
