<?php

namespace App\Http\Controllers\api\app\coaching;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class AppWishlistController extends Controller
{
    public function addToWishlist(Request $request){
        Wishlist::create(
            [
                'user_id'=>auth()->user()->id,
                'wish_id'=>$request->input('coaching_id'),
                'type'=>"coaching"
            ]
        );
        return response()->json(['message'=>'success'],200);
    }

    public function removeFromWishlist(Request $request){
        Wishlist::where(
            [
                ['user_id','=',auth()->user()->id],
                ['wish_id','=',$request->input('coaching_id')]
            ]
        )->delete();
        return response()->json(['message'=>'success'],200);
    }

    
}
