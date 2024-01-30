<?php

namespace App\Http\Controllers\api\app\etweet;

use App\Http\Controllers\Controller;
use App\Models\etweet\EtPostReply;
use Illuminate\Http\Request;

class AppPostReplyController extends Controller
{
    public function reply(Request $request){
        EtPostReply::create(
            [
                'user_id'=>auth()->user()->id,
                'post_id'=>$request->input('post_id'),
                'content'=>$request->input('content'),
            ]
        );

        return response()->json(['message'=>'success'],200);
    }   

    public function deleteReply(Request $request){
        $reply_id = $request->input('id');
        EtPostReply::where('id',$reply_id)->delete();
        return response()->json(['message'=>'success'],200);
    }

    public function replies(){
        $replies = EtPostReply::where('user_id',auth()->user()->id)->get();
        return response()->json(['message'=>'success','data'=>$replies],200);
    }

    public function replylike(Request $request){
        $reply = EtPostReply::find($request->input('id'));
        EtPostReply::find($request->input('id'))->update(
            [
                'likes'=>$reply->likes + 1,
            ]
        );
        return response()->json(['message'=>'success'],200);
    }
    
    public function replydislike(Request $request){
        $reply = EtPostReply::find($request->input('id'));
        EtPostReply::find($request->input('id'))->update(
            [
                'dislikes'=>$reply->dislikes + 1,
            ]
        );
        return response()->json(['message'=>'success'],200);
    }
    
}
