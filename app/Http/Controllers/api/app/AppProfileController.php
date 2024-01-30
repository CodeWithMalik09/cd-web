<?php

namespace App\Http\Controllers\api\app;

use App\Http\Controllers\Controller;
use App\Models\etweet\EtBookmarks;
use App\Models\etweet\EtFollower;
use App\Models\etweet\EtPost;
use App\Models\etweet\EtPostLike;
use App\Models\etweet\EtPostReply;
use Illuminate\Http\Request;

class AppProfileController extends Controller
{
    public function profile(){
        $user = auth()->user();
        $user->{'joined_on'} = date('F Y',strtotime($user->created_at));
        $user->{'user_detail'} = $user->userDetail;
        $user->user_detail->{'dob'} = date('d F Y',strtotime($user->user_detail['dob']));
        $user->user_detail->{'thumbnail'} = url('storage').'/'.$user->user_detail['thumbnail'];
        if($user->user_detail['image']){
            $user->user_detail->{'image'} = url('storage').'/'.$user->user_detail['image'];
        }else{
            $user->user_detail->{'image'} = asset('assets/boy.png');
        }
        $followers  = EtFollower::where('following_id',$user->id)->get();
        $user->{'followers'} = count($followers);
        $following = EtFollower::where('follower_id',$user->id)->get();
        $user->{'following'} = count($following);
        unset($user->user_detail['created_at']);
        unset($user->user_detail['updated_at']);
        unset($user->user_detail['id']);
        unset($user->user_detail['user_id']);
        return response()->json(['message'=>'success','user'=>$user]);
    }

    public function myposts(Request $request){
        $posts = EtPost::select(['id','user_id','stats_id','image','content','video','created_at'])->where('user_id',auth()->user()->id)->orderBy('id','DESC')->offset(10 * $request->input('offset'))->limit(10)->get();
        
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

            $post->{'user_full_name'} = $post->user['name'];
            $post->{'username'} = $post->user['username'];
            $post->{'date'} = date('d M',strtotime($post->created_at));
            $post->{'comment_count'} = $post->comments->count();
            unset($post->user);
            unset($post->stats);
            unset($post->user_id);
            unset($post->stats_id);
            unset($post->likes);
            unset($post->comments);
        }
        return response()->json(['message'=>'success','posts'=>$posts],200);
    }

    public function postReplies(){
        $replies = EtPostReply::select(['id','post_id','user_id','content','created_at'])->where('user_id',auth()->user()->id)->get();
        foreach ($replies as $reply) {
            if($reply->user->userDetail['image']){
                $reply->{'userimage'} = url('storage').'/'.$reply->user->userDetail['image'];
            }else{
                $reply->{'userimage'} = null;
            }
            $reply->{'username'} = $reply->user['name'];
            $reply->{'userid'} = $reply->user['username'];
            $reply->{'date'} = date('d F',strtotime($reply->created_at));
            $reply->{'replied_to'} = $reply->post->user->userid;
            unset($reply->post);
            unset($reply->created_at);
            unset($reply->user->userDetail);
            unset($reply->user);
        }
        return response()->json(['message'=>'success','replies'=>$replies],200);
    }


    public function postsLiked(){
        $likedPosts = EtPostLike::select(['post_id','created_at'])->where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        foreach ($likedPosts as $like) {
            $like->{'date'} = date('d F',strtotime($like->created_at));
            unset($like->created_at);
            $post  = $like->post;
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
        }
        return response()->json(['message'=>'success','postsliked'=>$likedPosts],200);
    }
}
