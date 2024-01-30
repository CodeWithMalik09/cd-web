<?php

namespace App\Http\Controllers\api\app;

use App\Http\Controllers\Controller;
use App\Models\etweet\EtFollower;
use App\Models\User;
use Illuminate\Http\Request;

class AppFollowController extends Controller
{
    public function following()
    {
        $users = array();
        $followings = EtFollower::where('follower_id', auth()->user()->id)->get();
        foreach ($followings as $following) {
            $user = User::select(['name', 'id', 'username'])->find($following->following_id);
            if ($user->userDetail && $user->userDetail['image']) {
                $user->{'image'} = url('storage') . '/' . $user->userDetail['image'];
            } else {
                $user->{'image'} = asset('assets/boy.png');
            }
            unset($user->userDetail);
            array_push($users, $user);
        }
        return response()->json(['message' => 'success', 'following' => $users]);
    }

    public function followers()
    {
        $users = array();
        $followers = EtFollower::where('following_id', auth()->user()->id)->get();
        foreach ($followers as $follower) {
            $user = User::select(['name', 'id', 'username'])->find($follower->follower_id);
            $user->{'image'} = url('storage') . '/' . $user->userDetail['image'];
            unset($user->userDetail);
            array_push($users, $user);
        }
        return response()->json(['message' => 'success', 'followers' => $users]);
    }

    public function follow(Request $request)
    {

        if (EtFollower::where("following_id", $request->input('user_id'))->where('follower_id', auth()->user()->id)->count() == 0) {
            EtFollower::create(
                [
                    'following_id' => $request->input('user_id'),
                    'follower_id' => auth()->user()->id,
                ]
            );
            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['message' => 'You are already following him.'], 200);
        }
    }

    public function unfollow(Request $request)
    {
        EtFollower::where(
            [
                ['following_id', '=', $request->input('following_id')],
                ['follower_id', '=', auth()->user()->id],
            ]
        )->delete();
        return response()->json(['message' => 'success']);
    }

    public function followSuggestions()
    {
        $suggestions = collect();
        $users = User::select(['id', 'name', 'username'])->where('id','<>',auth()->user()->id)->get();
        foreach ($users as $user) {
            if (EtFollower::where([['follower_id', '=', auth()->user()->id], ['following_id', '=', $user->id]])->get()->count() == 0) {
                if ($user->userDetail && $user->userDetail['image']) {
                    $user->{'image'} = url('storage') . '/' . $user->userDetail['image'];
                } else {
                    $user->{'image'} = null;
                }
                unset($user->userDetail);
                $suggestions->push($user);
                // array_push($suggestions,$user);
            }
        }
        return response()->json(['message' => 'success', 'suggestions' => $suggestions->take(8)], 200);
    }
}
