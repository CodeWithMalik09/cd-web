<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\etweet\EtBookmarks;
use App\Models\etweet\EtPost;
use App\Models\etweet\EtPostLike;
use App\Models\etweet\EtPostReply;
use App\Models\etweet\EtPostStats;
use Illuminate\Http\Request;

class DashboardPostController extends Controller
{
    public function index(){
        $posts = EtPost::all();
        return view('dashboard.post.index',['posts'=>$posts]);
    }

    public function delete($id){
        $posts = EtPost::find($id)->delete();
        EtPostReply::where('post_id',$id)->delete();
        EtPostLike::where('post_id',$id)->delete();
        EtPostStats::where('post_id',$id)->delete();
        EtBookmarks::where('post_id',$id)->delete();

        return redirect('dashboard/posts')->with('message','Post deleted successfully.');
    }
}
