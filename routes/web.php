<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InsuranceTypeController;
use App\Http\Controllers\SettingController;


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

    Route::get('/liste-type-assurance', [InsuranceTypeController::class, 'index'])->name('insurance-type.index');
    Route::get('/type-assurance/{id}', [InsuranceTypeController::class, 'add'])->name('insurance-type.add');
    Route::post('/save-insurance-type', [InsuranceTypeController::class, 'save'])->name('insurance-type.save');
    Route::get('/delete-insurance-type', [InsuranceTypeController::class, 'delete'])->name('insurance-type.delete');
        
  
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


    Route::get('/configuration-du-site', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/save-setting', [SettingController::class, 'save'])->name('setting.save');
    
});