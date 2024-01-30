<?php

namespace App\Http\Controllers\api\etweetweb;

use App\Http\Controllers\Controller;
use App\Models\etweet\EtFollower;
use App\Models\etweet\EtHastag;
use App\Models\etweet\EtPost;
use App\Models\etweet\EtPostLike;
use App\Models\User;
use Illuminate\Http\Request;

class EtWebExploreController extends Controller
{
    public function index(){
        $data = array();
        $tags = EtHastag::orderBy('hits','DESC')->limit(5)->get();

        foreach ($tags as $tag) {
            $posts = EtPost::where('content','LIKE','%#'.$tag.'%')->get();
            array_push($data,array(
                'tag_name'=>$tag->tag,
                'hits'=>$tag->hits,
                'posts'=>$posts,
            ));
        }

        return response()->json(['message'=>'success','data'=>$data],200);
    }

    public function trendingtags(){
        $data = array();
        $tags = EtHastag::orderBy('hits','DESC')->limit(5)->get();

        foreach ($tags as $tag) {
            $posts = EtPost::where('content','LIKE','%#'.$tag.'%')->get();
            array_push($data,array(
                'tag_name'=>$tag->tag,
                'hits'=>$tag->hits,
            ));
        }

        return response()->json(['message'=>'success','data'=>$data],200);
    }

    public function latesttags(){
        $data = array();
        $tags = EtHastag::orderBy('id','DESC')->limit(5)->get();

        foreach ($tags as $tag) {
            $posts = EtPost::where('content','LIKE','%#'.$tag.'%')->get();
            array_push($data,array(
                'tag_name'=>$tag->tag,
                'hits'=>$tag->hits,
                'posts'=>$posts,
            ));
        }

        return response()->json(['message'=>'success','data'=>$data],200);
    }

    public function upsctags(){
        $data = array();
        $tags = EtHastag::where('tag','LIKE','%'.'upsc'.'%')->limit(20)->get();

        foreach ($tags as $tag) {
            $posts = EtPost::where('content','LIKE','%#'.$tag.'%')->get();
            array_push($data,array(
                'tag_name'=>$tag->tag,
                'hits'=>$tag->hits,
                'posts'=>$posts,
            ));
        }

        return response()->json(['message'=>'success','data'=>$data],200);
    }

    public function ssctags(){
        $data = array();
        $tags = EtHastag::where('tag','LIKE','%'.'ssc'.'%')->limit(25)->get();

        foreach ($tags as $tag) {
            $posts = EtPost::where('content','LIKE','%#'.$tag.'%')->get();
            array_push($data,array(
                'tag_name'=>$tag->tag,
                'hits'=>$tag->hits,
                'posts'=>$posts,
            ));
        }

        return response()->json(['message'=>'success','data'=>$data],200);
    }

    public function tagpost(Request $request){
        $posts = EtPost::select(['id','user_id','stats_id','image','content','video','created_at'])->where('content','like','%#'.$request->input('tag').'%')->orderBy('id','DESC')->get();
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
            $post->{'username'} = $post->user['name'];
            $post->{'userid'} = $post->user['username'];
            $post->{'date'} = date('d F Y',strtotime($post->created_at));
            $post->{'comment_count'} = $post->comments->count();
            unset($post->user);
            unset($post->stats);
            unset($post->user_id);
            unset($post->stats_id);
            unset($post->likes);
            unset($post->comments);
        }

        $userArr = array();
        $peoples = User::where('role','student')->get();
        foreach ($peoples as $people) {
            $check_following = EtFollower::where([['follower_id','=',auth()->user()->id],['following_id','=',$people->id]])->get();
            if($check_following->count() == 0){
                if(count($userArr) < 4){
                    if($people->userDetail['image'] != null){
                        $people->{'image'} = url('storage').'/'.$people->userDetail['image'];
                    }
                    array_push($userArr,$people);
                }
            }
        }

        return response()->json(['message'=>'success','posts'=>$posts,'users'=>$userArr],200);
    }

}
