<?php

namespace App\Http\Controllers\api\etweetweb;

use App\Http\Controllers\Controller;
use App\Models\etweet\EtFollower;
use App\Models\etweet\EtPost;
use App\Models\etweet\EtPostLike;
use App\Models\etweet\EtPostReply;
use App\Models\etweet\EtUserDetail;
use App\Models\User;
use Illuminate\Http\Request;

class EtWebProfileController extends Controller
{
    public function profileDetails(){
        $profile = auth()->user();
        $followers = EtFollower::where('following_id',$profile->id)->get()->count();
        $following = EtFollower::where('follower_id',$profile->id)->get()->count();
        $profile->{'followers'} = $followers;
        $profile->{'following'} = $following;
        $profile->{'joined_on'} = date('d F Y',strtotime($profile->created_at));
        $user_detail = EtUserDetail::where('user_id',$profile->id)->get()->first();
        $profile->{'bio'} = $user_detail->bio ?? "";
        $profile->{'location'} = $user_detail->location ?? "";
        $profile->{'posts_count'} = $profile->posts->count();
        unset($profile->posts);
        $profile->{'dob'} = $user_detail->dob ?? "";
        $profile->{'weblink'} = $user_detail->website_link ?? "";

        if($user_detail && $user_detail->image){
            $profile->{'image'} = url('storage').'/'.$user_detail->image;
        }else{
            $profile->{'image'} = asset('assets/boy.png');
        }
        if($user_detail && $user_detail->thumbnail){
            $profile->{'thumbnail'} = url('storage').'/'.$user_detail->thumbnail;
        }else{
            $profile->{'thumbnail'} = asset('assets/defaultback.jpg');
        }
        
        return response()->json(['message'=>'success','profile'=>$profile],200);
    }

    public function updateDetails(Request $request){
        User::find(auth()->user()->id)->update(
            [
                'name'=>$request->input('name')
            ]
        );
        $detail_update = [
            'bio'=>$request->input('bio'),
            'location'=>$request->input('location'),
            'website_link'=>$request->input('link'),
            'dob'=>$request->input('dob')
        ];

        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = $file->store('public/etprofile');
            $expath = explode('/',$path);
            $detail_update['image'] = $expath[1].'/'.$expath[2];
        }
        if($request->hasFile('thumbnail')){
            $file = $request->file('thumbnail');
            $path = $file->store('public/etthumbnail');
            $expath = explode('/',$path);
            $detail_update['thumbnail'] = $expath[1].'/'.$expath[2];
        }

        EtUserDetail::where('user_id',auth()->user()->id)->update(
           $detail_update
        );
        return response()->json(['message'=>'success'],200);
    }

    public function followers(){
        $followers = EtFollower::where('following_id',auth()->user()->id)->get();
        $userArr = array();
        foreach ($followers as $follower) {
            $user = User::find($follower->follower_id);
            array_push($userArr,$user);
        }
        return response()->json(['message'=>'success','followers'=>$userArr]);
    }

    public function followings(){
        $followings = EtFollower::where('follower_id',auth()->user()->id)->get();
        $userArr =  array();
        foreach ($followings as $following) {
            $user = User::find($following->following_id);
            $user->{'bio'} = "Adipisicing esse cupidatat consequat deserunt sit veniam velit officia.";
            array_push($userArr,$user);
        }
        return response()->json(['message'=>'success','followings'=>$userArr],200);
    }


    public function replies(){
        $replies = EtPostReply::where('user_id',auth()->user()->id)->get();
        foreach ($replies as $reply) {
            $reply->{'user_name'} = $reply->user['name'];
            $reply->{'id'} = $reply->following_id;
            if($reply->user->userDetail && $reply->user->userDetail['image']){
                $reply->{'user_image'} = url('storage').'/'.$reply->user->userDetail['image'];
            }else{
                $reply->{'user_image'} = asset('assets/boy.png');
            }
            $reply->{'user_id'} = $reply->user['username'];
            $reply->{'date'} = date('d F Y',strtotime($reply->created_at));
        }
        return response()->json(['message'=>'success','replies'=>$replies],200);
    }

    public function myPost(){
        $posts = EtPost::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        foreach ($posts as $post) {
            if(EtPostLike::where([['user_id','=',auth()->user()->id],['post_id','=',$post->id]])->get()->count() >= 1){
                $post->{'liked'} = true;
            }else{
                $post->{'liked'} = false;
            }
            $post->{'likes_count'} = count($post->likes);
            if($post->user->userDetail && $post->user->userDetail['image']){
                $post->{'userimage'} = url('storage').'/'.$post->user->userDetail['image'];
            }else{
                $post->{'userimage'} = asset('assets/boy.png');
            }
            if($post->image){
                $post->{'image'} = url('storage').'/'.$post->image;
            }
            if($post->video){
                $post->{'video'} = url('storage').'/'.$post->video;
            }
            if($post->user_id == auth()->user()->id){
                $post->{'owner'} = true;
            }
            $post->{'username'} = $post->user['name'];
            $post->{'userid'} = $post->user['username'];
            $post->{'date'} = date('d F Y',strtotime($post->created_at));
            $post->{'comment_count'} = $post->comments->count();

        }

        return response()->json(['message'=>'success','posts'=>$posts],200);
    }
}
