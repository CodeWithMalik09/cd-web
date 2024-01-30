<?php

use App\Http\Controllers\api\etweetweb\EtWebBookmarkController;
use App\Http\Controllers\api\etweetweb\EtWebExploreController;
use App\Http\Controllers\api\etweetweb\EtWebFollowController;
use App\Http\Controllers\api\etweetweb\EtWebLoginController;
use App\Http\Controllers\api\etweetweb\EtWebPostController;
use App\Http\Controllers\api\etweetweb\EtWebProfileController;
use App\Http\Controllers\api\etweetweb\EtWebReplyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('etw/checkusername',[EtWebLoginController::class,'checkUsername']);
Route::post('etw/login',[EtWebLoginController::class,'login']);
Route::post('etw/send-otp',[EtWebLoginController::class,'sendOtp']);
Route::post('etw/verify-otp',[EtWebLoginController::class,'verifyOTP']);

Route::post('etw/register',[EtWebLoginController::class,'register']);


Route::middleware(['auth:sanctum'])->prefix('etw')->group(function(){
    
    //Posts
    Route::post('posts',[EtWebPostController::class,'index']);
    Route::post('lazyposts',[EtWebPostController::class,'lazyposts']);
    Route::post('gettweet',[EtWebPostController::class,'tweet']);
    Route::post('createpost',[EtWebPostController::class,'create']);
    Route::post('postlike',[EtWebPostController::class,'postLike']);
    Route::post('postdislike',[EtWebPostController::class,'postDislike']);
    Route::post('reportpost',[EtWebPostController::class,'reportPost']);
    Route::post('deletepost',[EtWebPostController::class,'deletePost']);
    Route::post('searchpost',[EtWebPostController::class,'searchpost']);
    Route::post('job-posts',[EtWebPostController::class,'jobPosts']);

    //Explore
    Route::post('explore',[EtWebExploreController::class,'index']);
    Route::post('trendingtags',[EtWebExploreController::class,'trendingtags']);
    Route::post('latesttags',[EtWebExploreController::class,'latesttags']);
    Route::post('upsctags',[EtWebExploreController::class,'upsctags']);
    Route::post('ssctags',[EtWebExploreController::class,'ssctags']);
    Route::post('tagpost',[EtWebExploreController::class,'tagpost']);


    //Follow
    Route::post('follow',[EtWebFollowController::class,'follow']);
    Route::post('followings',[EtWebFollowController::class,'following']);
    Route::post('followers',[EtWebFollowController::class,'followers']);
    Route::post('unfollow',[EtWebFollowController::class,'unfollow']);

    //Reply
    Route::post('reply',[EtWebReplyController::class,'reply']);
    Route::post('deletereply',[EtWebReplyController::class,'deleteReply']);
    Route::post('replies',[EtWebReplyController::class,'replies']);

    //Bookmark
    Route::post('mybookmarks',[EtWebBookmarkController::class,'myBookmarks']);
    Route::post('bookmark',[EtWebBookmarkController::class,'bookmark']);
    Route::post('removebookmark',[EtWebBookmarkController::class,'removeBookmark']);

    //Profile
    Route::post('myposts',[EtWebProfileController::class,'myPost']);
    Route::post('profiledetails',[EtWebProfileController::class,'profileDetails']);
    Route::post('updateprofile',[EtWebProfileController::class,'updateDetails']);
    // Route::post('followers',[EtWebProfileController::class,'followers']);
    // Route::post('followings',[EtWebProfileController::class,'followings']);
    Route::post('replies',[EtWebProfileController::class,'replies']);

});
