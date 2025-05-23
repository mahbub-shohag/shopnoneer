<?php

use App\Http\Controllers\AmenityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FaqController;
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
Route::get('/permission_import',[PermissionController::class,'permission_import'])->name('permission_import');
Route::get('/import',[PermissionController::class,'import'])->name('import');
/*..Permissions..*/

Route::get('/division',[DivisionController::class,'index']);

/*Districts*/
Route::resource('/district',DistrictController::class);
Route::post('/districts_by_division_id', [DistrictController::class, 'districtsByDivisionId'])->name('districts_by_division_id');


/*Districts*/



/*Upazillas*/
Route::resource('/upazila',UpazilaController::class);
Route::post('/upazillas_by_district_id', [UpazilaController::class, 'upazillasByDistrictId'])->name('upazillas_by_district_id');

/*Upazillas*/

/*City*/
Route::resource('/city',CityController::class);
Route::post('/cities_by_upazila_id', [UpazilaController::class, 'citiesByUpazilaId'])->name('cities_by_upazila_id');

/*City*/

/*Housing*/
Route::resource('/housing',HousingController::class);
Route::post('/housings_by_upazila_id', [HousingController::class, 'housingsByUpazilaId'])->name('housings_by_upazila_id');

/*Housing*/

/*Project*/
Route::resource('/project',ProjectController::class);
Route::get('project-list',[ProjectController::class,'projectList'])->name('project.list');
/*Project*/

/*Project*/
Route::resource('/profiles',ProfileController::class);
Route::get('profile_list',[ProfileController::class,'profile_list']);
/*Project*/

/*Category*/
Route::resource('/category',CategoryController::class);
Route::post('/categories_by_category_id', [CategoryController::class, 'categoriesByCategoryId'])->name('categories_by_category_id');

/*Category*/

/*Facility*/
Route::resource('/facility',FacilityController::class);
Route::post('/facilities_by_upazila_id', [FacilityController::class, 'facilitiesByUpazilaId'])->name('facilities_by_upazila_id');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
//ALl controller and method
Route::get('/controllers-actions', [RoleController::class, 'getControllersAndActions']);
Route::resource('/faq',FaqController::class);
Route::resource('/contact',ContactController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');




