<?php

namespace App\Http\Controllers\api\app\etweet;

use App\Http\Controllers\Controller;
use App\Models\etweet\EtBookmarks;
use App\Models\etweet\EtFollower;
use App\Models\etweet\EtHastag;
use App\Models\etweet\EtPost;
use App\Models\etweet\EtPostLike;
use App\Models\etweet\EtPostStats;
use App\Models\User;
use Illuminate\Http\Request;

class AppPostController extends Controller
{
    public function posts(Request $request){
        $posts = EtPost::select(['id','user_id','stats_id','image','content','video','created_at'])->orderBy('id','DESC')->offset(10 * $request->input('offset'))->limit(10)->orderBy('id','desc')->get();
            // $posts = EtPost::select(['id','user_id','stats_id','image','content','video','created_at'])->orderBy('id','DESC')->limit(10)->get();
        // $posts = "";
        // if($request->input('offset') != 0){
        // }else{
        // }
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
            if($post->user->userDetail && $post->user->userDetail['image']){
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
            $post->{'share_url'} = "http://etweet.coachingdetail.com/$post->id";

            $post->{'user_full_name'} = $post->user['name'];
            $post->{'username'} = $post->user['username'];
            $post->{'userid'} = $post->user['id'];
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


    public function post(Request $request){
        $post = EtPost::find($request->input('post_id'));
        if(EtPostLike::where([['user_id','=',auth()->user()->id],['post_id','=',$post->id]])->get()->count() >= 1){
            $post->{'liked'} = true;
        }else{
            $post->{'liked'} = false;
        }
        $post->{'likes_count'} = count($post->likes);
        if( $post->user->userDetail && $post->user->userDetail['image']){
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
        if(EtBookmarks::where([['user_id','=',auth()->user()->id],['post_id','=',$post->id]])->get()->count() == 1){
            $post->{'bookmarked'} = true;
        }else{
            $post->{'bookmarked'} = false;
        }
        $post->{'bookmark_count'} = EtBookmarks::where('post_id',$post->id)->get()->count();
        $post->{'date'} = date('d F',strtotime($post->created_at));
        $post->{'user_full_name'} = $post->user['name'];
        $post->{'username'} = $post->user['username'];
        $post->{'userid'} = $post->user['id'];
        foreach ($post->comments as $comment) {
            $comment->{'username'} = $comment->user['name'];
            $comment->{'userid'} = $comment->user['username'];
            if($comment->user->userDetail['image']){
                $comment->{'userimage'} = url('storage').'/'.$comment->user->userDetail['image'];
            }else{
                $comment->{'userimage'} = asset('assets/boy.png');
            }
        }
        return response()->json(['message'=>'success','post'=>$post],200);
    }

    public function create(Request $request){
        if($request->input('type') == "edit"){
            $post = EtPost::find($request->input('id'));
            $createData = [
                'content'=>$request->input('content')
            ];
            if($request->hasFile('image')){
                if($post->video){
                    unlink(public_path('storage').'/'.$post->video);
                    $createData['video'] = null;
                }else{
                    if($post->image){
                        unlink(public_path('storage').'/'.$post->image);
                    }
                    $file = $request->file('image');
                    $path = $file->store('public/postimage');
                    $extpath = explode('/',$path);
                    $createData['image'] = $extpath[1].'/'.$extpath[2];
                }
            }
            if($request->hasFile('video')){
                if($post->image){
                    unlink(public_path('storage').'/'.$post->image);
                    $createData['image'] = null;
                }else{
                    if($post->video){
                        unlink(public_path('storage').'/'.$post->video);
                    }
                    $file = $request->file('video');
                    $path = $file->store('public/postvideo');
                    $extpath = explode('/',$path);
                    $createData['video'] = $extpath[1].'/'.$extpath[2];
                }
            }
            EtPost::find($request->input('id'))->update(
                $createData
            );
            return response()->json(['message'=>'success','data'=>'Post edited successfully.'],200);
        }

        $content = $request->input('content');
        $content_words = explode(' ',$content);
        foreach ($content_words as $word) {
            if(str_starts_with($word,'#')){
                $check_tag = EtHastag::where('tag',substr($word,1))->get();
                if($check_tag->count() >= 1){
                    EtHastag::find($check_tag->first()->id)->update([
                        'tag'=>substr($word,1),
                        'hits'=>$check_tag->first()->hits + 1,
                    ]);
                }else{
                    EtHastag::create([
                        'tag'=>substr($word,1),
                        'hits'=>1
                    ]);
                }
            }
        }

        $stats = EtPostStats::create();
        $createData = [
            'user_id'=>auth()->user()->id,
            'stats_id'=>$stats->id,
            'content'=>$request->input('content')
        ];
        
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = $file->store('public/postimage');
            $extpath = explode('/',$path);
            $createData['image'] = $extpath[1].'/'.$extpath[2];
        }
        if($request->hasFile('video')){
            $file = $request->file('video');
            $path = $file->store('public/postvideo');
            $extpath = explode('/',$path);
            $createData['video'] = $extpath[1].'/'.$extpath[2];
        }
        EtPost::create(
            $createData
        );
        return response()->json(['message'=>'success'],200);
    }

}
