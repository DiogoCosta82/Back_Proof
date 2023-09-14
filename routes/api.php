<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/* Route du controller AuthController   */
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');

    Route::match(['get', 'post'], 'update', 'updateProfile');

    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

    Route::delete('/delete/', 'destroy');
});


/* Route de Controller ForgetPassword */
Route::get("/forget-password", [ForgetPasswordController::class, "forgetPassword"])
    ->name('forget.password');
Route::post("/forget-password", [ForgetPasswordController::class, "forgetPasswordPost"])
    ->name('forget.password.post');
Route::get("/reset-password/{token}", [ForgetPasswordController::class, "resetPassword"])
    ->name('reset.password');
Route::post('/reset-password/', [ForgetPasswordController::class, 'resetPasswordPost'])
    ->name('reset.password.post');