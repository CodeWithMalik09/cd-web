<?php

use App\Http\Controllers\CoachingRegistrationController;

use App\Http\Controllers\DataHandleController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\student\EnrollmentController;
use App\Http\Controllers\student\StudentController;
use App\Http\Controllers\student\StudentDashboardController;
use App\Http\Controllers\TutorRegistrationController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('change-city-ids',[DataHandleController::class,'convertCitiesArrayToId']);

Route::get('linkstorage', function () {
    Artisan::call('config:cache');
    Artisan::call('storage:link');
});

//Transformers
// Route::get('addslug',[DataHandleController::class,'addslug']);
Route::get('data-transform',[DataHandleController::class,'replaceCoachingThumbnail']);
// Route::get('move-gallery',[DataHandleController::class,'moveGallery']);
// Route::get('generate-coaching-slug',[DataHandleController::class,'generateCoachingSlug']);


Route::get('/', [FrontendController::class, 'home']);

Route::get('coachinglist', function () {
    return view('coachinglist');
});

Route::get('coaching', function () {
    return view('coaching');
});

//Student
Route::get('login', [StudentController::class, 'login']);
Route::post('login', [StudentController::class, 'validateLogin']);
Route::post('verifyphone', [StudentController::class, 'verifyNumber']);
Route::get('phoneverification', [StudentController::class, 'verifyScreen']);
Route::get('send-otp', [StudentController::class, 'resendOTP']);
Route::post('studentregistration', [StudentController::class, 'registration']);
Route::get('studentlogout', [StudentController::class, 'logout']);
Route::post('addtowishlist', [StudentController::class, 'addToWishlist']);
Route::post('send-otp', [StudentController::class, 'sendOtp']);

//Student
Route::middleware(['studentaccess'])->prefix('user')->group(function () {
    Route::get('profile', [StudentDashboardController::class, 'profile']);
    Route::post('update', [StudentController::class, 'update']);
    Route::get('wishlist', [StudentDashboardController::class, 'wishlist']);
    Route::get('enrollments', [StudentDashboardController::class, 'enrollments']);
    Route::get('print-page/{id}', [StudentDashboardController::class, 'printenrollment']);
});

//Enrollment
Route::get('onlineadmission/{coaching_id}', [EnrollmentController::class, 'enrollNow']);
Route::post('onlineadmission', [EnrollmentController::class, 'enroll']);


Route::get('blogs', [FrontEndController::class, 'blog']);
Route::get('blog/{id}', [FrontEndController::class, 'blogview']);

//Jobs
Route::get('jobs', [JobController::class, 'index']);
Route::get('job/{id}', [JobController::class, 'item']);
Route::any('search-job-post', [JobController::class, 'search']);
Route::any('search-blog-post', [FrontendController::class, 'BlogSearch']);

//Search
Route::get('course/{slug}', [SearchController::class, 'course']);
Route::get('topcoachings/{slug}', [SearchController::class, 'topcoachings']);
Route::get('search-by-name/{text}',[SearchController::class,'searchByCoachingName']);
Route::get('search-by-name-city/{text}/{city}',[SearchController::class,'searchByCoachingNameCity']);
Route::get('homesearch/{type}/{course}', [FrontendController::class, 'homeonlinesearch']);
Route::get('homesearch/{type}/{course}/{city}', [FrontendController::class, 'homesearch']);
Route::get('coachings/{city}', [FrontendController::class, 'cityhomesearch']);
Route::get('search/{search}', [FrontendController::class, 'search']);
Route::get('coaching/{name}', [FrontendController::class, 'coaching']);
Route::get('feestructure/{id}', [FrontendController::class, 'feestructure']);
Route::get('libraryfeestructure/{id}',[FrontendController::class,'libraryfeestructure']);
Route::get('libraryfacilitystructure/{id}',[FrontendController::class,'libraryfacilitystructure']);
Route::get('faculties/{id}', [FrontendController::class, 'faculties']);
Route::get('results/{type}/{id}', [FrontendController::class, 'results']);

//Review
Route::get('write-review/{slug}', [ReviewController::class, 'writeReview']);
Route::post('store-review', [ReviewController::class, 'storeReview']);

//Filter
Route::post('filtercoachings', [FilterController::class, 'coachingFilter']);

Route::get('compare/{coachings}', [FrontendController::class, 'compare']);
Route::get('mapsearch/{type}/{course}/{city}', [FrontendController::class, 'mapSearch']);
Route::get('mapview/{id}', [FrontendController::class, 'mapview']);

Route::get('registration', [CoachingRegistrationController::class, 'coachingregistration']);
Route::post('coachingregistration', [CoachingRegistrationController::class, 'createCoaching']);
Route::get('coachingregistration', function () {
    return view('coachingregistrationsteptwo');
});
Route::post('coachingdetailsubmission', [CoachingRegistrationController::class, 'stepTwoSubmission']);
Route::post('steptwosubmission', [CoachingRegistrationController::class, 'stepTwoSubmit']);
Route::post('addcoachinggallery', [CoachingRegistrationController::class, 'addgallery']);

Route::get('verification', [VerificationController::class, 'verifyscreen']);
Route::post('verification', [VerificationController::class, 'verify']);

//Static
Route::get('about', [FrontendController::class, 'aboutUs']);
Route::get('contact', [FrontendController::class, 'contactUs']);
Route::get('disclaimer', [FrontendController::class, 'disclaimer']);
Route::get('privacy-policy', [FrontendController::class, 'privacyPolicy']);
Route::post('submit-contact-message',[ContactController::class,'store']);

//Tutor
Route::get('tutors/{course}/{city}', [FrontendController::class, 'tutorslist']);
Route::post('tutorregistration', [TutorRegistrationController::class, 'register']);
Route::get('comparetutor/{tutors}', [FrontendController::class, 'comparetutor']);
Route::get('tutor/{name}', [FrontendController::class, 'tutor']);
Route::post('tutordetailsubmission', [TutorRegistrationController::class, 'adddetails']);
Route::get('resendotp', [TutorRegistrationController::class, 'resendOTP']);

//Coaching Data for SearchByName
Route::post('getcoachingbyname', [FrontendController::class, 'getCoachingData']);


//Library
Route::get('libraries/{city}', [FrontendController::class, 'librarylist']);
Route::get('library/{name}', [FrontendController::class, 'library']);
Route::get('maplibrarysearch/{city}', [FrontendController::class, 'mapLibrarySearch']);
Route::get('maplibraryview/{id}', [FrontendController::class, 'mapLibraryview']);

//Sitemap
Route::get('sitemap', [SitemapController::class, 'index']);
