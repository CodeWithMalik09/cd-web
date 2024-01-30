<?php

namespace App\Http\Controllers\api\app\etweet;

use App\Http\Controllers\Controller;
use App\Models\etweet\EtBookmarks;
use App\Models\etweet\EtHastag;
use App\Models\etweet\EtPost;
use App\Models\etweet\EtPostLike;
use Illuminate\Http\Request;

class AppExploreController extends Controller
{
    public function tagposts(Request $reqeust){
        $tagposts = array();

        $posts = EtPost::where('content','LIKE','%#'.$reqeust->input('tag').'%')->get();
        foreach ($posts as $post) {
            if(EtPostLike::where([['user_id','=',auth()->user()->id],['post_id','=',$post->id]])->get()->count() >= 1){
                $post->{'liked'} = true;
            }else{
                $post->{'liked'} = false;
            }
            $post->{'likes_count'} = count($post->likes);
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
            if($post->user_id == auth()->user()->id){
                $post->{'owner'} = true;
            }
            if(EtBookmarks::where([['user_id','=',auth()->user()->id],['post_id','=',$post->id]])->get()->count() == 1){
                $post->{'bookmarked'} = true;
            }else{
                $post->{'bookmarked'} = false;
            }
            $post->{'bookmark_count'} = EtBookmarks::where('post_id',$post->id)->get()->count();

            $post->{'username'} = $post->user['name'];
            $post->{'userid'} = $post->user['username'];
            $post->{'date'} = date('d M',strtotime($post->created_at));
            $post->{'comment_count'} = $post->comments->count();
            unset($post->user);
            unset($post->stats);
            unset($post->user_id);
            unset($post->stats_id);
            unset($post->likes);
            unset($post->comments);
            array_push($tagposts,$post);
        }

        return response()->json(['message'=>'success','posts'=>$tagposts],200);
    }

    public function trendingTags(){
        $data = array();
        $tags = EtHastag::orderBy('hits','DESC')->limit(10)->get();

        foreach ($tags as $tag) {
            // $posts = EtPost::where('content','LIKE','%#'.$tag.'%')->get();
            array_push($data,array(
                'tag_name'=>$tag->tag,
                'hits'=>$tag->hits,
                'date'=>date('d F',strtotime($tag->created_at))
            ));
        }

        return response()->json(['message'=>'success','tags'=>$data],200);
    }
}
