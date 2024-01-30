<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Course;
use Illuminate\Http\Request;

class DashboardBlogController extends Controller
{
    public function blogs()
    {
        $blogs = Blog::orderBy('id', 'desc')->get();
        // if (auth()->user()->role == "admin") {
        // } else {
        //     $blogs = Blog::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        // }
        return view('dashboard.blog.blogs', ['blogs' => $blogs]);
    }

    public function createBlog()
    {
        $courses = Course::all();
        return view('dashboard.blog.createblog', ['courses' => $courses]);
    }

    public function insertBlog(Request $request)
    {
        $file = $request->file('thumbnail');
        $path = $file->store('public/blog');
        $expath = explode('/', $path);
        Blog::create([
            'user_id' => auth()->user()->id,
            'category' => $request->type,
            'course' => json_encode(str_replace('/', '-', $request->course_id)),
            'slug' => $request->slug,
            'heading' => $request->input('heading'),
            'content' => $request->input('content'),
            'blog_url'=>$request->input('blog_url'),
            'short_description' => $request->input('short_description'),
            'title'=>$request->input('title'),
            'meta'=>$request->input('meta'),
            'keywords'=>$request->input('keywords'),
            'thumbnail' => $expath[1] . '/' . $expath[2],
            'job_last_date'=> $request->input('job_last_date')
        ]);
        return redirect('dashboard/blogs');
    }

    public function editBlog($id)
    {
        $blog = Blog::find($id);
        $courses = Course::all();
        return view('dashboard.blog.editblog', ['blog' => $blog, 'courses' => $courses]);
    }

    public function updateBlog(Request $request)
    {
        if ($request->file('thumbnail')) {
            $thumbnail = Blog::find($request->input('id'))->thumbnail;
             if ($thumbnail && file_exists(public_path('storage') . '/' . $thumbnail)) {
            unlink(public_path('storage') . '/' . $thumbnail);
            }
            $file = $request->file('thumbnail');
            $path = $file->store('public/blog');
            $expath = explode('/', $path);
            Blog::where('id', $request->input('id'))->update(
                [
                    'category' => $request->type,
                    'course' => json_encode(str_replace('/', '-', $request->course_id)),
                    'slug' => $request->slug,
                    'heading' => $request->input('heading'),
                     'short_description' => $request->input('short_description'),
                    'title'=>$request->input('title'),
                    'meta'=>$request->input('meta'),
                    'keywords'=>$request->input('keywords'),
                     'blog_url'=>$request->input('blog_url'),
                    'content' => $request->input('content'),
                    'thumbnail' => $expath[1] . '/' . $expath[2],
                    'job_last_date'=> $request->input('job_last_date')

                ]
            );
        } else {
            Blog::where('id', $request->input('id'))->update(
                [
                    'category' => $request->type,
                    'course' => json_encode(str_replace('/', '-', $request->course_id)),
                    'slug' => $request->slug,
                    'heading' => $request->input('heading'),
                    'content' => $request->input('content'),
                    'title'=>$request->input('title'),
                     'meta'=>$request->input('meta'),
                     'blog_url'=>$request->input('blog_url'),
                     'keywords'=>$request->input('keywords'),
                      'short_description' => $request->input('short_description'),
                    'job_last_date'=> $request->input('job_last_date')

                ]
            );
        }
       
        return redirect('dashboard/blogs')->with('messsage', 'blog updated successfully.');
    }

    public function search(Request $request)
    {
        $blogs = Blog::where('heading', 'like', '%' . $request->search . '%')->orWhere('course', 'like', '%' . $request->search . '%')->orderBy('id', 'desc')->get();
        return view('dashboard.blog.blogs', ['blogs' => $blogs, 'search' => $request->search]);
    }

    public function deleteBlog($id)
    {
        if(auth()->user()->username != 'shubhangitq'){
            Blog::find($id)->delete();
            return redirect('dashboard/blogs');
        }else{
            return redirect('dashboard/blogs')->with('message','You are not allowed to delete this blog.');
        }
    }
}
