<?php

namespace App\Http\Controllers\api\etweetweb;

use App\Http\Controllers\Controller;
use App\Models\etweet\EtFollower;
use Illuminate\Http\Request;

class EtWebFollowController extends Controller
{

    public function follow(Request $request){
        $following_id = $request->input('id');
        EtFollower::create(
            [
                'follower_id'=>auth()->user()->id,
                'following_id'=>$following_id
            ]
        );
        return response()->json(['message'=>'success'],200);
    }

    public function unfollow(Request $request){
        $following_id = $request->input('following_id');
        EtFollower::where([['follower_id','=',auth()->user()->id],['following_id','=',$following_id]])->delete();
        return response()->json(['message'=>'success'],200);
    }

    public function followers(){
        $followers = EtFollower::where('following_id',auth()->user()->id)->get();
        foreach ($followers as $follower) {
            $follower->{'user_name'} = $follower->followingUser['name'];
            $follower->{'id'} = $follower->following_id;
            if($follower->followingUser->userDetail['image']){
                $follower->{'user_image'} = url('storage').'/'.$follower->followingUser->userDetail['image'];
            }else{
                $follower->{'user_image'} = asset('assets/boy.png');
            }
            $follower->{'user_id'} = $follower->followingUser['username'];
            $follower->{'bio'} = $follower->followingUser->userDetail['bio'];
        }
        return response()->json(['message'=>'success','data'=>$followers],200);
    }

    public function following(){
        $followings = EtFollower::where('follower_id',auth()->user()->id)->get();
        foreach ($followings as $following) {
            $following->{'user_name'} = $following->followingUser['name'];
            $following->{'id'} = $following->following_id;
            if($following->followingUser->userDetail['image']){
                $following->{'user_image'} = url('storage').'/'.$following->followingUser->userDetail['image'];
            }else{
                $following->{'user_image'} = asset('assets/boy.png');
            }
            $following->{'user_id'} = $following->followingUser['username'];
            $following->{'bio'} = $following->followingUser->userDetail['bio'];
        }
        return response()->json(['message'=>'success','data'=>$followings],200);
    }

}
