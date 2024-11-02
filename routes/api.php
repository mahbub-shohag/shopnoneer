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
});
