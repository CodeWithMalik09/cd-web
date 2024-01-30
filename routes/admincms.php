<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\CityController;
use App\Http\Controllers\dashboard\LocalityController;
use App\Http\Controllers\dashboard\CMSUserController;
use App\Http\Controllers\dashboard\CourseController;
use App\Http\Controllers\dashboard\DashboardAchivementController;
use App\Http\Controllers\dashboard\DashboardBlogController;
use App\Http\Controllers\dashboard\DashboardCoachingController;
use App\Http\Controllers\dashboard\DashboardLibraryController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\DashboardEnrollmentController;
use App\Http\Controllers\dashboard\DashboardFeeStructureController;
use App\Http\Controllers\dashboard\DashboardPostController;
use App\Http\Controllers\dashboard\DashboardTutorController;
use App\Http\Controllers\dashboard\DashboardUserController;
use App\Http\Controllers\dashboard\DashboardStudentController;
use App\Http\Controllers\dashboard\MediaController;

//ADMIN DASHBOARD ROUTES

Route::get('cms', [DashboardController::class, 'login']);
Route::post('cms', [DashboardController::class, 'logincheck']);


Route::middleware(['adminaccess'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'home']);

    //Students
    Route::get('students', [DashboardStudentController::class, 'students']);
   Route::get('latest_loggedin_students', [DashboardStudentController::class, 'lateststudents']);
    Route::get('student-enrollments/{id}', [DashboardStudentController::class, 'enrollments']);


    //Coachings
    Route::any('search-coaching', [DashboardCoachingController::class, 'searchCoaching']);
    Route::get('coachings', [DashboardCoachingController::class, 'coachings']);
    Route::get('unapproved-coachings', [DashboardCoachingController::class, 'unapprovedCoachings']);
    Route::get('applied', [DashboardCoachingController::class, 'applied']);
    Route::get('seokeywords', [DashboardCoachingController::class, 'seokeywords']);
    Route::get('addkeywords', [DashboardCoachingController::class, 'addkeywords']);
    Route::post('insertkeyword', [DashboardCoachingController::class, 'insertkeyword']);
    Route::get('deletekeyword/{id}', [DashboardCoachingController::class, 'deletekeyword']);
    Route::get('editkeyword/{id}', [DashboardCoachingController::class, 'editkeyword']);
    Route::post('updatekeyword', [DashboardCoachingController::class, 'updatekeyword']);
    Route::get('approve-coaching/{id}', [DashboardCoachingController::class, 'approveCoaching']);
    Route::get('createcoaching', [DashboardCoachingController::class, 'createCoaching']);
    Route::post('insertcoaching', [DashboardCoachingController::class, 'insertCoaching']);
    Route::get('approve/{id}', [DashboardCoachingController::class, 'approve_Coaching']);
    Route::get('unapprove/{id}', [DashboardCoachingController::class, 'unapprove_Coaching']);
    Route::get('editcoaching/{id}', [DashboardCoachingController::class, 'editCoaching']);
    Route::get('editappliedcoaching/{id}', [DashboardCoachingController::class, 'editappliedCoaching']);
    Route::post('updatecoaching', [DashboardCoachingController::class, 'updateCoaching']);
    Route::get('deletecoaching/{id}', [DashboardCoachingController::class, 'deleteCoaching']);
    Route::get('deleteappliedcoaching/{id}', [DashboardCoachingController::class, 'deleteappliedCoaching']);
    Route::get('delete-coaching-gallery-image/{id}', [DashboardCoachingController::class, 'deleteCoachingGalleryImage']);
    Route::post('delete-result-and-achivement', [DashboardCoachingController::class, 'deleteResultAndAchivement']);
    Route::post('delete-faculty-from-coaching', [DashboardCoachingController::class, 'deleteFacultyFromCoaching']);
    Route::post('delete-fee-structure', [DashboardCoachingController::class, 'deleteFeeStructure']);
    Route::get('coaching-enrollments/{id}', [DashboardCoachingController::class, 'enrollments']);




    //FeeStructure
    Route::get('new-fee-structure', [DashboardFeeStructureController::class, 'create']);
    Route::post('store-fee-structure', [DashboardFeeStructureController::class, 'store']);

    //Result And Achivement
    Route::get('new-result-achivement', [DashboardAchivementController::class, 'create']);
    Route::post('new-result-achivement', [DashboardAchivementController::class, 'store']);

    // Tutor
    Route::any('search-tutor', [DashboardTutorController::class, 'searchTutor']);
    Route::get('tutors', [DashboardTutorController::class, 'tutor']);
    Route::get('createtutor', [DashboardTutorController::class, 'createTutor']);
    Route::post('inserttutor', [DashboardTutorController::class, 'insertTutor']);
    Route::get('edittutor/{id}', [DashboardTutorController::class, 'editTutor']);
    Route::post('updatetutor', [DashboardTutorController::class, 'updateTutor']);
    Route::get('deletetutor/{id}', [DashboardTutorController::class, 'deleteTutor']);

    //Libraries
    Route::get('libraries', [DashboardLibraryController::class, 'Libraries']);
    Route::any('search-library', [DashboardLibraryController::class, 'searchLibrary']);
    Route::get('createlibrary', [DashboardLibraryController::class, 'createLibrary']);
    Route::post('insertlibrary', [DashboardLibraryController::class, 'insertLibrary']);
    Route::get('editlibrary/{id}', [DashboardLibraryController::class, 'editLibrary']);
    Route::post('updatelibrary', [DashboardLibraryController::class, 'updateLibrary']);
    Route::get('deletelibrary/{id}', [DashboardLibraryController::class, 'deleteLibrary']);
    Route::get('delete-library-gallery-image/{id}', [DashboardLibraryController::class, 'deleteLibraryGalleryImage']);



    //Blogs
    Route::get('blogs', [DashboardBlogController::class, 'blogs']);
    Route::get('createblog', [DashboardBlogController::class, 'createBlog']);
    Route::post('insertblog', [DashboardBlogController::class, 'insertBlog']);
    Route::get('editblog/{id}', [DashboardBlogController::class, 'editBlog']);
    Route::post('updateblog', [DashboardBlogController::class, 'updateBlog']);
    Route::get('deleteblog/{id}', [DashboardBlogController::class, 'deleteBlog']);
    Route::post('search-blog',[DashboardBlogController::class,'search']);
    Route::get('blog-media',[MediaController::class,'index']);
    Route::post('blog-upload-media',[MediaController::class,'upload']);
    Route::get('blog-delete-media/{id}',[MediaController::class,'delete']);


    Route::get('courses', [CourseController::class, 'courses']);
    Route::post('createcourse', [CourseController::class, 'createCourse']);
    Route::get('editcourse/{id}', [CourseController::class, 'editCourse']);
    Route::post('updatecourse', [CourseController::class, 'updateCourse']);
    Route::get('deletecourse', [CourseController::class, 'deleteCourse']);

    Route::get('categories', [CategoryController::class, 'categories']);
    Route::post('createcategory', [CategoryController::class, 'createCategory']);
    Route::get('deletecategory/{id}', [CategoryController::class, 'deleteCategory']);

    Route::get('cities', [CityController::class, 'cities']);
    Route::post('createcity', [CityController::class, 'createCity']);
    Route::get('deletecity/{id}', [CityController::class, 'deleteCity']);

    //Locality
    Route::get('localities', [LocalityController::class, 'localities']);
    Route::post('createlocality', [LocalityController::class, 'createLocality']);
    Route::post('search-locality',[LocalityController::class,'searchLocality']);
    Route::get('deletelocality/{id}', [LocalityController::class, 'deleteLocality']);
    
    //Users
    Route::get('siteusers', [DashboardUserController::class, 'index']);
    Route::get('delete-user/{id}', [DashboardUserController::class, 'delete']);

    //CMS Users
    Route::get('cms-users', [CMSUserController::class, 'index']);
    Route::get('cms-user-view/{id}', [CMSUserController::class, 'cmsUserView']);
    Route::get('new-cms-user', [CMSUserController::class, 'newCMSUser']);
    Route::post('new-cms-user', [CMSUserController::class, 'storeCMSUser']);
    Route::get('change-cms-user-role/{id}', [CMSUserController::class, 'changeUserRole']);
    Route::get('cms-user-edit/{id}', [CMSUserController::class, 'editCMSUser']);
    Route::post('cms-user-update', [CMSUserController::class, 'CMSUserUpdate']);
    Route::get('edit-profile',[DashboardController::class,'editProfile']);
    


    //Posts
    Route::get('posts', [DashboardPostController::class, 'index']);
    Route::get('delete-post/{id}', [DashboardPostController::class, 'delete']);

    //Enrollments
    Route::get('enrollments',[DashboardEnrollmentController::class,'index']);
    Route::get('view-enrollment/{id}',[DashboardEnrollmentController::class,'show']);
    Route::get('edit-enrollment/{id}',[DashboardEnrollmentController::class,'edit']);
     Route::get('verify-enrollment/{id}',[DashboardEnrollmentController::class,'verify']);
     Route::get('unverify-enrollment/{id}',[DashboardEnrollmentController::class,'unverify']);
    Route::get('delete-enrollment/{id}',[DashboardEnrollmentController::class,'delete']);


    Route::get('logout', [DashboardController::class, 'logout']);
});
