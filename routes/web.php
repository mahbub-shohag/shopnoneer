<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HousingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/signup',[AuthController::class,'showRegistration'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);

/*Users*/
Route::get('/users',[UserController::class, 'index']);
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->middleware('admin')->name('user.edit');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
/*..Users..*/

/*Roles*/
Route::resource('roles', RoleController::class);
/*..Roles..*/

/*Permissions*/
Route::resource('permissions', PermissionController::class);
/*..Permissions..*/

Route::get('/division',[DivisionController::class,'index']);

/*Districts*/
Route::resource('/district',DistrictController::class);
Route::post('/districts_by_division_id', [DivisionController::class, 'districtsByDivisionId'])->name('districts_by_division_id');


/*Districts*/



/*Upazillas*/
Route::resource('/upazila',UpazilaController::class);
Route::post('/upazillas_by_district_id', [DistrictController::class, 'upazillasByDistrictId'])->name('upazillas_by_district_id');

/*Upazillas*/

/*City*/
Route::resource('/city',CityController::class);
Route::post('/cities_by_upazila_id', [UpazilaController::class, 'citiesByUpazilaId'])->name('cities_by_upazila_id');

/*City*/

/*Housing*/
Route::resource('/housing',HousingController::class);
/*Housing*/

/*Project*/
Route::resource('/project',ProjectController::class);
Route::get('project-list',[ProjectController::class,'projectList'])->name('project.list');
/*Project*/

/*Project*/
Route::resource('/profiles',ProfileController::class);
Route::get('profile_list',[ProfileController::class,'profile_list']);
/*Project*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
