<?php

namespace App\Http\Controllers\api\etweetweb;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\etweet\EtBookmarks;
use App\Models\etweet\EtFollower;
use App\Models\etweet\EtHastag;
use App\Models\etweet\EtPost;
use App\Models\etweet\EtPostLike;
use App\Models\etweet\EtPostReply;
use App\Models\etweet\EtPostReport;
use App\Models\etweet\EtPostRepost;
use App\Models\etweet\EtPostStats;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EtWebPostController extends Controller
{
    public function index(){
        $posts = EtPost::select(['id','user_id','stats_id','image','content','video','created_at'])->orderBy('id','DESC')->limit(10)->get();
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
        $peoples = User::where('role','student')->where('username','<>',null)->get();
        foreach ($peoples as $people) {
            $check_following = EtFollower::where([['follower_id','=',auth()->user()->id],['following_id','=',$people->id]])->get();
            if($check_following->count() == 0){
                if(count($userArr) < 4){
                    if($people->userDetail && $people->userDetail['image'] != null){
                        $people->{'image'} = url('storage').'/'.$people->userDetail['image'];
                    }
                    array_push($userArr,$people);
                }
            }
        }

        return response()->json(['message'=>'success','posts'=>$posts,'users'=>$userArr],200);
    }

    public function searchpost(Request $request){
        $posts = EtPost::select(['id','user_id','stats_id','image','content','video','created_at'])->where('content','like','%'.$request->input('search').'%')->orderBy('id','DESC')->limit(6)->get();
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

        return response()->json(['message'=>'success','posts'=>$posts],200);
    }


    public function lazyposts(Request $request){
        $posts = EtPost::select(['id','user_id','stats_id','image','content','video','created_at'])->orderBy('id','DESC')->offset(10 * $request->input('offset'))->limit(10)->get();
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

        return response()->json(['message'=>'success','posts'=>$posts],200);
    }

    public function tweet(Request $request){
        $post = EtPost::find($request->input('id'));
        if(EtPostLike::where([['user_id','=',auth()->user()->id],['post_id','=',$post->id]])->get()->count() >= 1){
            $post->{'liked'} = true;
        }else{
            $post->{'liked'} = false;
        }
        $post->{'likes_count'} = count($post->likes);
        if($post->user->userDetail['image']){
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
        $post->{'username'} = $post->user['name'];
        $post->{'userid'} = $post->user['username'];
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

    public function postLike(Request $request){
        
        EtPostLike::create(
            [
                'post_id'=>$request->input('id'),
                'user_id'=>auth()->user()->id,
            ]
        );
        return response()->json(['message'=>'success'],200);
    }

    public function postDislike(Request $request){
        EtPostLike::where([['user_id','=',auth()->user()->id],['post_id','=',$request->input('id')]])->delete();
        return response()->json(['message'=>'success'],200);
    }

    public function reportPost(Request $request){
        $stats_id = EtPost::find($request->input('id'))->stats_id;
        EtPostStats::where('id',$stats_id)->update(
            [
                'likes'=> EtPostStats::find($stats_id)->reports + 1,
            ]
        );
        return response()->json(['message'=>'success'],200);
    }

    public function deletePost(Request $request){
        $post = EtPost::find($request->input('id'));
        if($post->image){
            unlink(public_path('storage').'/'.$post->image);
        }
        if($post->video){
            unlink(public_path('storage').'/'.$post->video);
        }
        $post->delete();
        EtPostLike::where('post_id',$request->input('id'))->delete();
        EtPostReply::where('post_id',$request->input('id'))->delete();
        EtBookmarks::where('post_id',$request->input('id'))->delete();
        EtPostReport::where('post_id',$request->input('id'))->delete();
        EtPostStats::where('post_id',$request->input('id'))->delete();
        EtPostRepost::where('post_id',$request->input('id'))->delete();
        return response()->json(['message'=>'Post deleted successfully']);
    }

    public function jobPosts(){
        $posts = Blog::where('category','job')->orderBy('id','desc')->limit(6)->get();
        foreach ($posts as $key => $post) {
            $post->{'course'} = json_decode($post->course)[0];
            $post->{'thumbnail'} = url("storage/$post->thumbnail");
            $post->{'url'} = url("job/$post->slug");
        }
        return response()->json(['status'=>'success','data'=>$posts],200);
    }
}
