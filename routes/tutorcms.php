<?php

use App\Http\Controllers\tutor\TutorHomeController;
use App\Http\Controllers\tutor\TutorLoginController;
use Illuminate\Support\Facades\Route;

Route::get('tutorcms/login',[TutorLoginController::class,'login']);
Route::post('tutorcms/login',[TutorLoginController::class,'authenticate']);

Route::middleware(['tutoraccess'])->prefix('tutorcms')->group(function(){
    Route::get('/',[TutorHomeController::class,'home']);

});

?>