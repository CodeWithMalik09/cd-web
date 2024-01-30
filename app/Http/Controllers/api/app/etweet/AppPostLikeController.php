<?php

namespace App\Http\Controllers\api\app\etweet;

use App\Http\Controllers\Controller;
use App\Models\etweet\EtPostLike;
use Illuminate\Http\Request;

class AppPostLikeController extends Controller
{
    public function like(Request $request){
        
        EtPostLike::create(
            [
                'post_id'=>$request->input('post_id'),
                'user_id'=>auth()->user()->id,
            ]
        );
        return response()->json(['message'=>'success'],200);
    }

    public function removeLike(Request $request){
        EtPostLike::where([['user_id','=',auth()->user()->id],['post_id','=',$request->input('post_id')]])->delete();
        return response()->json(['message'=>'success'],200);
    }
}
