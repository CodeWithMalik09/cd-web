<?php

namespace App\Http\Controllers\api\app\etweet;

use App\Http\Controllers\Controller;
use App\Models\etweet\EtBookmarks;
use App\Models\etweet\EtPost;
use App\Models\etweet\EtPostLike;
use Illuminate\Http\Request;

class AppBookmarkController extends Controller
{
    public function myBookmarks(){
        $posts = array();
        $bookmarks = EtBookmarks::where('user_id',auth()->user()->id)->get();
        foreach ($bookmarks as $bookmark) {
            $post = EtPost::find($bookmark->post_id);
            if($post->image){
                $post->{'image'} = url('storage').'/'.$post->image;
            }
            if($post->video){
                $post->{'video'} = url('storage').'/'.$post->video;
            }
            if($post->user->userDetail['image']){
                $post->{'userimage'} = url('storage').'/'.$post->user->userDetail['image'];
            }else{
                $post->{'userimage'} = asset('assets/boy.png');
            }
            if(EtPostLike::where([['user_id','=',auth()->user()->id],['post_id','=',$post->id]])->get()->count() >= 1){
                $post->{'liked'} = true;
            }else{
                $post->{'liked'} = false;
            }
            if($post->user_id == auth()->user()->id){
                $post->{'owner'} = true;
            }
            $post->{'date'} = date('d F Y',strtotime($post->created_at));
            $post->{'likes_count'} = count($post->likes);
            $post->{'username'} = $post->user['name'];
            $post->{'userid'} = $post->user['username'];
            $post->{'comment_count'} = $post->comments->count();
            unset($post->user);
            unset($post->likes);
            unset($post->comments);
            array_push($posts,$post);
        }
        return response()->json(['message'=>'success','posts'=>$posts],200);
    }

    public function bookmark(Request $request){
        $check_bookmarks = EtBookmarks::where([['user_id','=',auth()->user()->id],['post_id','=',$request->input('id')]]);
        if($check_bookmarks->count() == 1){
            return response()->json(['message'=>'You have already bookmared this post.'],200);
        }else{
            EtBookmarks::create(
                [
                    'user_id'=>auth()->user()->id,
                    'post_id'=>$request->input('post_id'),
                ]
            );
            return response()->json(['message'=>'success'],200);
        }
    }

    public function removeBookmark(Request $request){
        EtBookmarks::where([['user_id','=',auth()->user()->id],['post_id','=',$request->input('post_id')]])->delete();
        return response()->json(['message'=>'success'],200);
    }
}
