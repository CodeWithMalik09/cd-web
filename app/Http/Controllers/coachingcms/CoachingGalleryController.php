<?php

namespace App\Http\Controllers\coachingcms;

use App\Http\Controllers\Controller;
use App\Models\Coaching;
use Illuminate\Http\Request;

class CoachingGalleryController extends Controller
{
    public function index(){
        $coaching = Coaching::find(session('coaching')->id);
        $images = json_decode($coaching->gallery);
        return view('coaching.gallery',['images'=>$images]);
    }
    
    public function upload(Request $request){
        $coaching = Coaching::find(session('coaching')->id);
        $images = json_decode($coaching->gallery);
        $item = $request->file('image');
        $img_name = $item->getClientOriginalName();
        $path = $item->store('public/coachinggallery');
        $extpath = explode('/',$path);
        array_push($images,$extpath[1].'/'.$extpath[2]);
        Coaching::find(session('coaching')->id)->update(
            [
                'gallery'=>$images,
            ]
        );
        return redirect('coachingcms/gallery');
    }

    public function delete(Request $request){
        $coaching = Coaching::find(session('coaching')->id);
        $images = json_decode($coaching->gallery);
        if(gettype($images) == "object"){
            $images = (array) $images;
        }
        unset($images[array_search($request->input('img'),$images)]);
        if(file_exists(public_path('storage').'/'.$request->input('img'))){
            unlink(public_path('storage').'/'.$request->input('img'));
        }
        Coaching::find(session('coaching')->id)->update(
            [
                'gallery'=>$images,
            ]
        );
        return response()->json(['message'=>'success','data'=>'Deleted Successfully'],200);
    }
}
