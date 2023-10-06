<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgetPasswordController;
//use App\Http\Controllers\DossierController;


// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);

//Route::get('/checkDossier', [DossierController::class, 'checkDossier']);

//Route::post('/createDossier', [DossierController::class, 'createDossier']);


// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/logout', 'AuthController@logout');
//     Route::post('/createDossier', 'DossierController@createDossier');
//     Route::post('/checkDossier', 'DossierController@checkDossier');
// });

/* Route de Controller ForgetPassword */
Route::get("/forget-password", [ForgetPasswordController::class, "forgetPassword"])
    ->name('forget.password');
Route::post("/forget-password", [ForgetPasswordController::class, "forgetPasswordPost"])
    ->name('forget.password.post');
Route::get("/reset-password/{token}", [ForgetPasswordController::class, "resetPassword"])
    ->name('reset.password');
Route::post('/reset-password/', [ForgetPasswordController::class, 'resetPasswordPost'])
    ->name('reset.password.post');


    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');

    });