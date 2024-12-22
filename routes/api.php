<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\HousingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
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

Route::post('/signupapi', [AuthController::class, 'signupapi']);
Route::post('loginapi',[AuthController::class,'loginapi']);

Route::middleware('auth:sanctum')->group(function (){
    Route::delete('logoutapi',[AuthController::class,'logoutapi']);

    Route::post('housing-list',[HousingController::class,'getHousingList']);

    Route::post('projectlist',[ProjectController::class,'getProjectList']);
    Route::post('get-project-by-id',[ProjectController::class,'getProjectById']);
    Route::post('get-project-by-filter',[ProjectController::class,'getProjectByFilter']);

    Route::post('add-favourite',[FavouriteController::class,'addFavourite']);
    Route::post('remove-favourite',[FavouriteController::class,'removeFavourite']);
    Route::post('favourite-list',[FavouriteController::class,'favouriteListByUser']);
    Route::post('update-user-profile',[UserController::class,'updateUserProfile']);
    Route::post('user-profile',[ProfileController::class,'userProfile']);
});
