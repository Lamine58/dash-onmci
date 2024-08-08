<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\MediatequeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\WebsiteController;

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

Route::get('/connexion', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

Route::middleware(['auth'])->group(function () {

    Route::get('/deconnexion', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    #utilisateur
    Route::get('/liste-des-utilisateurs', [UserController::class, 'index'])->name('user.index');
    Route::get('/utilisateur/{id}', [UserController::class, 'add'])->name('user.add');
    Route::post('/save-user', [UserController::class, 'save'])->name('user.save');
    Route::get('/delete-user', [UserController::class, 'delete'])->name('user.delete');

    #projet
    Route::get('/liste-des-projets', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/projet/{id}', [ProjectController::class, 'add'])->name('project.add');
    Route::post('/save-project', [ProjectController::class, 'save'])->name('project.save');
    Route::get('/delete-project', [ProjectController::class, 'delete'])->name('project.delete');

    #evenement
    Route::get('/liste-des-evenements', [EventController::class, 'index'])->name('event.index');
    Route::get('/evenement/{id}', [EventController::class, 'add'])->name('event.add');
    Route::post('/save-event', [EventController::class, 'save'])->name('event.save');
    Route::get('/delete-event', [EventController::class, 'delete'])->name('event.delete');

    #role
    Route::get('/liste-des-roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/{id}', [RoleController::class, 'add'])->name('role.add');
    Route::get('/role/permissions/{id}', [RoleController::class, 'permissions'])->name('role.permissions');
    Route::post('/save-role', [RoleController::class, 'save'])->name('role.save');
    Route::get('/delete-role', [RoleController::class, 'delete'])->name('role.delete');


    #permission
    Route::get('/liste-des-permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permission/{id}', [PermissionController::class, 'add'])->name('permission.add');
    Route::post('/save-permission', [PermissionController::class, 'save'])->name('permission.save');
    Route::post('/set-permission', [PermissionController::class, 'set_permission'])->name('set-permission.save');
    Route::get('/delete-permission', [PermissionController::class, 'delete'])->name('permission.delete');


    Route::get('/page/{page}', [WebsiteController::class, 'page'])->name('website.page');
    Route::post('/save-page', [WebsiteController::class, 'save'])->name('website.save');

    Route::get('/configuration-du-site', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/save-setting', [SettingController::class, 'save'])->name('setting.save');

    Route::get('/mediateque', [MediatequeController::class, 'index'])->name('mediateque.index');
    Route::get('/medias', [MediatequeController::class, 'medias'])->name('mediateque.medias');
    Route::post('/upload', [MediatequeController::class, 'upload'])->name('mediateque.upload');
    Route::get('/delete-mediateque', [MediatequeController::class, 'delete'])->name('mediateque.delete');
    

    #blogs
    Route::get('/liste-des-actualités', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/actualites/{id}', [BlogController::class, 'add'])->name('blog.add');
    Route::post('/save-blog', [BlogController::class, 'save'])->name('blog.save');
    Route::get('/delete-blog', [BlogController::class, 'delete'])->name('blog.delete');
});