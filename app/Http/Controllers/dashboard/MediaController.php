<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::orderBy('id', 'desc')->get();
        return view('dashboard.blog.media', ['media' => $media]);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('media')) {
            // dd($request->media);
            $file = $request->file('media');
            // dd($file->getClientOriginalExtension());
            $path = $file->storeAs('public/media/blog', $file->getClientOriginalName());
            $extpath = explode('/', $path);

            $img_formats = ['png', 'jpg', 'jpeg', 'webp', 'gif'];


            $media = Media::create(
                [
                    'type' => in_array($file->getClientOriginalExtension(), $img_formats) ? "IMAGE" : strtoupper($file->getClientOriginalExtension()),
                    'mime' => $file->getMimeType(),
                    'path' => $extpath[1] . '/' . $extpath[2] . '/' . $extpath[3]
                ]
            );
        }

        return redirect('dashboard/blog-media');
    }

    public function delete($id)
    {
        $media = Media::find($id);
        unlink(public_path('storage') . '/' . $media->path);
        Media::find($id)->delete();
        return redirect()->back()->with('message', 'Media deleted successfully.');
    }
}
