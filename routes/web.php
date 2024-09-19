<?php


use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashBoardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\UserCatalogueController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PostCatalogueController;
use App\Http\Controllers\Backend\PostController;
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


//User
Route::group(['prefix => backend', 'middleware' => ['admin', 'locale']], function () {
    // Dashboard
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('home.index');
    Route::get('/error403', [DashBoardController::class, 'error403'])->name('home.error403');
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
    Route::get('/user/catalogue/permission', [UserCatalogueController::class, 'permission'])->name('user.catalogue.permission');
    Route::post('/user/catalogue/updatePermission', [UserCatalogueController::class, 'updatePermission'])->name('user.catalogue.updatePermission');
    //permissions
    Route::get('/permission/index', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permission/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permission/{id}/edit', [PermissionController::class, 'edit'])->where(['id'=> '[0-9]+'])->name('permission.edit');
    Route::post('/permission/{id}/update', [PermissionController::class, 'update'])->where(['id'=> '[0-9]+'])->name('permission.update');
    Route::get('/permission/{id}/delete', [PermissionController::class, 'delete'])->where(['id'=> '[0-9]+'])->name('permission.delete');
    Route::delete('/permission/{id}/destroy', [PermissionController::class, 'destroy'])->where(['id'=> '[0-9]+'])->name('permission.destroy');

    //languages
    Route::get('/language/index', [LanguageController::class, 'index'])->name('language.index');
    Route::get('/language/create', [LanguageController::class, 'create'])->name('language.create');
    Route::post('/language/store', [LanguageController::class, 'store'])->name('language.store');
    Route::get('/language/{id}/edit', [LanguageController::class, 'edit'])->where(['id'=> '[0-9]+'])->name('language.edit');
    Route::post('/language/{id}/update', [LanguageController::class, 'update'])->where(['id'=> '[0-9]+'])->name('language.update');
    Route::get('/language/{id}/delete', [LanguageController::class, 'delete'])->where(['id'=> '[0-9]+'])->name('language.delete');
    Route::delete('/language/{id}/destroy', [LanguageController::class, 'destroy'])->where(['id'=> '[0-9]+'])->name('language.destroy');
    Route::get('/language/{id}/switch', [LanguageController::class, 'switchBackendLanguage'])->where(['id'=> '[0-9]+'])->name('language.switch');
    Route::get('/language/{id}/{languageId}/{model}/translate', [LanguageController::class, 'translate'])->where(['id'=> '[0-9]+', 'languageId' => '[0-9]+'])->name('language.translate');
    Route::post('/language/storeTranslate', [LanguageController::class, 'storeTranslate'])->name('language.storeTranslate');

    //postcatalogue
    Route::get('/post/catalogue/index', [PostCatalogueController::class, 'index'])->name('post.catalogue.index');
    Route::get('/post/catalogue/create', [PostCatalogueController::class, 'create'])->name('post.catalogue.create');
    Route::post('/post/catalogue/store', [PostCatalogueController::class, 'store'])->name('post.catalogue.store');
    Route::get('/post/catalogue/{id}/edit', [PostCatalogueController::class, 'edit'])->where(['id'=> '[0-9]+'])->name('post.catalogue.edit');
    Route::post('/post/catalogue/{id}/update', [PostCatalogueController::class, 'update'])->where(['id'=> '[0-9]+'])->name('post.catalogue.update');
    Route::get('/post/catalogue/{id}/delete', [PostCatalogueController::class, 'delete'])->where(['id'=> '[0-9]+'])->name('post.catalogue.delete');
    Route::delete('/post/catalogue/{id}/destroy', [PostCatalogueController::class, 'destroy'])->where(['id'=> '[0-9]+'])->name('post.catalogue.destroy');
    
    //post
    Route::get('/post/index', [PostController::class, 'index'])->name('post.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->where(['id'=> '[0-9]+'])->name('post.edit');
    Route::post('/post/{id}/update', [PostController::class, 'update'])->where(['id'=> '[0-9]+'])->name('post.update');
    Route::get('/post/{id}/delete', [PostController::class, 'delete'])->where(['id'=> '[0-9]+'])->name('post.delete');
    Route::delete('/post/{id}/destroy', [PostController::class, 'destroy'])->where(['id'=> '[0-9]+'])->name('post.destroy');

    

    Route::resources([
        'users' => 'UserController',
        'user_catalogues' => 'UserCatalogueController',
        'languages' => 'LanguageController',
        'post_catalogues' => 'PostCatalogueController',
        'posts' => 'PostController',
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


