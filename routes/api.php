<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\HousingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TranslationController;
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

Route::get('/send-test-mail', function () {
    Mail::raw('This is a test email using Gmail SMTP.', function ($message) {
        $message->to('mahbub.cse3@gmail.com')
                ->subject('Test Email');
    });

    return 'Email sent!';
});


Route::middleware('auth:sanctum')->group(function (){
    Route::delete('logoutapi',[AuthController::class,'logoutapi']);
    Route::post('add-favourite',[FavouriteController::class,'addFavourite']);
    Route::post('remove-favourite',[FavouriteController::class,'removeFavourite']);
    Route::post('favourite-list',[FavouriteController::class,'favouriteListByUser']);
    Route::post('update-user-profile',[ProfileController::class,'updateProfileAPI']);
    Route::post('user-profile',[ProfileController::class,'userProfile']);
    Route::post('translation',[TranslationController::class,'translation']);
    Route::post('change-password',[ProfileController::class,'changePassword']);
});

Route::middleware(['api-token'])->group(function () {
    Route::post('division-list',[DivisionController::class,'getDivisions']);
    Route::post('category-list',[CategoryController::class,'getCategory']);
    Route::post('faq-list',[FaqController::class,'getFaq']);
    Route::post('contact-list',[ContactController::class,'createContact']);
    Route::post('housing-list',[HousingController::class,'getHousingList']);
    Route::post('projectlist',[ProjectController::class,'getProjectList']);
    Route::post('get-project-by-id',[ProjectController::class,'getProjectById']);
    Route::post('get-project-by-filter',[ProjectController::class,'getProjectByFilter']);
    Route::post('get-notification-list',[NotificationController::class,'getNotificationList']);
    Route::post('/send-reset-code', [AuthController::class, 'sendResetCode']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});