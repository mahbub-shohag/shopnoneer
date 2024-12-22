<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/signupapi', [\App\Http\Controllers\AuthController::class, 'signupapi']);
Route::post('loginapi',[\App\Http\Controllers\AuthController::class,'loginapi']);

Route::middleware('auth:sanctum')->group(function (){
    Route::delete('logoutapi',[\App\Http\Controllers\AuthController::class,'logoutapi']);
    Route::post('projectlist',[\App\Http\Controllers\ProjectController::class,'getProjectList']);
    Route::post('get-project-by-id',[\App\Http\Controllers\ProjectController::class,'getProjectById']);
    Route::post('get-project-by-filter',[\App\Http\Controllers\ProjectController::class,'getProjectByFilter']);

    Route::post('add-favourite',[\App\Http\Controllers\FavouriteController::class,'addFavourite']);
    Route::post('remove-favourite',[\App\Http\Controllers\FavouriteController::class,'removeFavourite']);
    Route::post('favourite-list',[\App\Http\Controllers\FavouriteController::class,'favouriteListByUser']);
    Route::post('housing-list',[\App\Http\Controllers\HousingController::class,'getHousingList']);
    Route::post('update-user-profile',[\App\Http\Controllers\UserController::class,'updateUserProfile']);
    Route::post('user-profile',[\App\Http\Controllers\ProfileController::class,'userProfile']);

});
