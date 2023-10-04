<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DossierController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::get('/user', [AuthController::class, 'user']);
// });

// Route::get('/checkDossier', 'DossierController@checkDossier');
// Route::post('/createDossier', 'DossierController@createDossier');


Route::get('/checkDossier', [DossierController::class, 'checkDossier']);

Route::post('/createDossier', [DossierController::class, 'createDossier']);

