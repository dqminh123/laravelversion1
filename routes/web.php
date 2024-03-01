<?php


use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashBoardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\UserCatalogueController;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Ajax\DashBoardController as AjaxDashboardController;

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
    return view('welcome');
});
// Authentication Backend
Route::get('/backend/dashboard', [DashBoardController::class, 'index'])
    ->name('home.index')->middleware('admin');


//User
Route::group(['prefix => backend', 'middleware' => 'admin'], function () {
    //user
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->where(['id'=> '[0-9]+'])->name('user.edit');
    Route::post('/user/{id}/update', [UserController::class, 'update'])->where(['id'=> '[0-9]+'])->name('user.update');
    Route::get('/user/{id}/delete', [UserController::class, 'delete'])->where(['id'=> '[0-9]+'])->name('user.delete');
    Route::delete('/user/{id}/destroy', [UserController::class, 'destroy'])->where(['id'=> '[0-9]+'])->name('user.destroy');
    
    //usercatalogue
    Route::get('/user/catalogue/index', [UserCatalogueController::class, 'index'])->name('user.catalogue.index');
    Route::get('/user/catalogue/create', [UserCatalogueController::class, 'create'])->name('user.catalogue.create');
    Route::post('/user/catalogue/store', [UserCatalogueController::class, 'store'])->name('user.catalogue.store');
    Route::get('/user/catalogue/{id}/edit', [UserCatalogueController::class, 'edit'])->where(['id'=> '[0-9]+'])->name('user.catalogue.edit');
    Route::post('/user/catalogue/{id}/update', [UserCatalogueController::class, 'update'])->where(['id'=> '[0-9]+'])->name('user.catalogue.update');
    Route::get('/user/catalogue/{id}/delete', [UserCatalogueController::class, 'delete'])->where(['id'=> '[0-9]+'])->name('user.catalogue.delete');
    Route::delete('/user/catalogue/{id}/destroy', [UserCatalogueController::class, 'destroy'])->where(['id'=> '[0-9]+'])->name('user.catalogue.destroy');
    
    //languages
    Route::get('/language/index', [LanguageController::class, 'index'])->name('language.index');
    Route::get('/language/create', [LanguageController::class, 'create'])->name('language.create');
    Route::post('/language/store', [LanguageController::class, 'store'])->name('language.store');
    Route::get('/language/{id}/edit', [LanguageController::class, 'edit'])->where(['id'=> '[0-9]+'])->name('language.edit');
    Route::post('/language/{id}/update', [LanguageController::class, 'update'])->where(['id'=> '[0-9]+'])->name('language.update');
    Route::get('/language/{id}/delete', [LanguageController::class, 'delete'])->where(['id'=> '[0-9]+'])->name('language.delete');
    Route::delete('/language/{id}/destroy', [LanguageController::class, 'destroy'])->where(['id'=> '[0-9]+'])->name('language.destroy');


    Route::resources([
        'users' => 'UserController',
        'user_catalogues' => 'UserCatalogueController',
        'languages' => 'LanguageController'
    ]);
});

//Ajax
Route::get('ajax/location/getLocation',[LocationController::class, 'getLocation'])
->name('ajax.location.getLocation')->middleware('admin');
Route::post('ajax/dashboard/changeStatus',[AjaxDashboardController::class, 'changeStatus'])
->name('ajax.dashboard.changeStatus')->middleware('admin');
Route::post('ajax/dashboard/changeStatusAll',[AjaxDashboardController::class, 'changeStatusAll'])
->name('ajax.dashboard.changeStatusAll')->middleware('admin');

//dang nhap
Route::get('admin', [AuthController::class, 'index'])->name('auth.admin')->middleware('login');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');

