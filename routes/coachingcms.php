<?php

use App\Http\Controllers\coachingcms\CoachingFacultyController;
use App\Http\Controllers\coachingcms\CoachingFeesController;
use App\Http\Controllers\coachingcms\CoachingGalleryController;
use App\Http\Controllers\coachingcms\CoachingHomeController;
use App\Http\Controllers\coachingcms\CoachingLoginController;
use App\Http\Controllers\coachingcms\CoachingResultsController;
use Illuminate\Support\Facades\Route;


Route::get('coachingcms',[CoachingLoginController::class,'login']);
Route::post('coachingcms',[CoachingLoginController::class,'authenticate']);

Route::middleware(['coachingaccess'])->prefix('coachingcms')->group(function(){
    Route::get('home',[CoachingHomeController::class,'home']);

    //faculty
    Route::get('faculties',[CoachingFacultyController::class,'index']);
    Route::get('createfaculty',[CoachingFacultyController::class,'createView']);
    Route::post('createfaculty',[CoachingFacultyController::class,'create']);
    Route::get('editfaculty/{id}',[CoachingFacultyController::class,'editView']);
    Route::post('editfaculty',[CoachingFacultyController::class,'update']);
    Route::get('deletefaculty/{id}',[CoachingFacultyController::class,'delete']);

    //fees
    Route::get('fees',[CoachingFeesController::class,'index']);
    Route::get('createfeestructure',[CoachingFeesController::class,'createView']);
    Route::post('createfeestructure',[CoachingFeesController::class,'create']);
    Route::get('editfeestructure/{id}',[CoachingFeesController::class,'editView']);
    Route::post('editfeestructure',[CoachingFeesController::class,'update']);
    Route::get('deletefeestructure/{id}',[CoachingFeesController::class,'delete']);

    //Results And Achivement
    Route::get('results',[CoachingResultsController::class,'index']);
    Route::get('createresults',[CoachingResultsController::class,'createView']);
    Route::post('createresults',[CoachingResultsController::class,'create']);
    Route::get('editresults/{id}',[CoachingResultsController::class,'editView']);
    Route::post('editresults',[CoachingResultsController::class,'update']);
    Route::get('deleteresults/{id}',[CoachingResultsController::class,'delete']);

    //gallery
    Route::get('gallery',[CoachingGalleryController::class,'index']);
    Route::post('deletegalleryimage',[CoachingGalleryController::class,'delete']);
    Route::post('uploadgalleryimage',[CoachingGalleryController::class,'upload']);

    Route::get('logout',[CoachingLoginController::class,'logout']);
});


?>