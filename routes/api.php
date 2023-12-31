<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\IndicateurDataController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::match(['get', 'post'], 'update', 'updateProfile');
    Route::delete('/delete/', 'destroy');
});

/* Route de Controller DossierController */
Route::get('/checkDossier', [DossierController::class, 'checkDossier']);
Route::post('/createDossier', [DossierController::class, 'createDossier']);
Route::get('/getDossiers', [DossierController::class, 'getDossiers']);


/* Route de Controller ForgetPassword */
Route::get("/forget-password", [ForgetPasswordController::class, "forgetPassword"])
    ->name('forget.password');
Route::post("/forget-password", [ForgetPasswordController::class, "forgetPasswordPost"])
    ->name('forget.password.post');
Route::get("/reset-password/{token}", [ForgetPasswordController::class, "resetPassword"])
    ->name('reset.password');
Route::post('/reset-password/', [ForgetPasswordController::class, 'resetPasswordPost'])
    ->name('reset.password.post');


/* Route de Controller IndicateurDataController */

Route::post('/indicateur-data', [IndicateurDataController::class, 'store']);
