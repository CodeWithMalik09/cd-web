<?php

use App\Http\Controllers\api\app\AppBlogController;
use App\Http\Controllers\api\app\AppFollowController;
use App\Http\Controllers\api\app\AppLoginController;
use App\Http\Controllers\api\app\AppProfileController;
use App\Http\Controllers\api\app\coaching\AppCoachingController;
use App\Http\Controllers\api\app\library\AppLibraryController;
use App\Http\Controllers\api\app\coaching\AppWishlistController;
use App\Http\Controllers\api\app\etweet\AppBookmarkController;
use App\Http\Controllers\api\app\etweet\AppExploreController;
use App\Http\Controllers\api\app\etweet\AppPostController;
use App\Http\Controllers\api\app\etweet\AppPostLikeController;
use App\Http\Controllers\api\app\etweet\AppPostReplyController;
use App\Http\Controllers\api\app\student\AppEnrollmentController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Whatsapp Webhook
Route::any('whatsapp-webhook',[WhatsappController::class,'webhookCallback']);

Route::post('check-username',[AppLoginController::class,'checkUsername']);
Route::post('signup',[AppLoginController::class,'register']);
Route::post('send-otp',[AppLoginController::class,'sendOtp']);
Route::post('verify-otp',[AppLoginController::class,'verifyOTP']);

Route::post('login',[AppLoginController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    //profile
    Route::post('updateprofile',[AppLoginController::class,'updateProfile']);
    Route::post('profile',[AppProfileController::class,'profile']);
    Route::post('myposts',[AppProfileController::class,'myposts']);
    Route::post('postreplies',[AppProfileController::class,'postReplies']);
    Route::post('postsliked',[AppProfileController::class,'postsLiked']);

    //tags
    Route::post('trendingtags',[AppExploreController::class,'trendingTags']);
    Route::post('trendingtagposts',[AppExploreController::class,'tagposts']);

    //Following
    Route::post('following',[AppFollowController::class,'following']);
    Route::post('followers',[AppFollowController::class,'followers']);
    Route::post('follow',[AppFollowController::class,'follow']);
    Route::post('unfollow',[AppFollowController::class,'unfollow']);
    Route::post('followsuggestions',[AppFollowController::class,'followSuggestions']);

    Route::post('posts',[AppPostController::class,'posts']);
    Route::post('post',[AppPostController::class,'post']);
    Route::post('createpost',[AppPostController::class,'create']);

    //Bookmark
    Route::post('mybookmarks',[AppBookmarkController::class,'myBookmarks']);
    Route::post('bookmark',[AppBookmarkController::class,'bookmark']);
    Route::post('removebookmark',[AppBookmarkController::class,'removeBookmark']);

    //Like
    Route::post('like',[AppPostLikeController::class,'like']);
    Route::post('removelike',[AppPostLikeController::class,'removeLike']);

    //Comments
    Route::post('addcomment',[AppPostReplyController::class,'reply']);

    //Coaching
    Route::post('searchfetch',[AppCoachingController::class,'searchFetch']);
    Route::post('coachings',[AppCoachingController::class,'coachings']);
    Route::post('search-coachings',[AppCoachingController::class,'searchCoaching']);
    Route::post('map-search-coachings',[AppCoachingController::class,'mapSearchCoaching']);
    Route::post('coaching',[AppCoachingController::class,'coaching']);
    Route::post('feestructure',[AppCoachingController::class,'feeStructure']);
    Route::post('resultsandachivements',[AppCoachingController::class,'resultsAndAchivements']);
    Route::post('faculties',[AppCoachingController::class,'faculties']);
    Route::post('coachings-with-less-info',[AppCoachingController::class,'coachingsWithLessDetails']);

    
    
    //Blogs
    Route::post('blogs',[AppBlogController::class,'index']);
    Route::post('blog',[AppBlogController::class,'blog']);
    Route::post('search-blog-post',[AppBlogController::class,'search']);

    //Library
    Route::post('get-cities',[AppLibraryController::class,'getCities']);
    Route::post('search-library',[AppLibraryController::class,'searchLibrary']);
    Route::post('map-search-libraries',[AppLibraryController::class,'mapSearchLibrary']);
    Route::post('library',[AppLibraryController::class,'library']);
    Route::post('recently-added-library',[AppLibraryController::class,'recentlyAddedLibrary']);

    //Student

    Route::get('onlineadmission/{coaching_id}', [AppEnrollmentController::class, 'enrollNow']);
    Route::post('onlineadmission',[AppEnrollmentController::class,'enroll']);
    Route::get('enrollments',[AppEnrollmentController::class,'enrollments']); 

});

//CoachingWishlist
Route::post('addtowishlist',[AppWishlistController::class,'addToWishlist']);
Route::post('removefromwishlist',[AppWishlistController::class,'removeFromWishlist']);
