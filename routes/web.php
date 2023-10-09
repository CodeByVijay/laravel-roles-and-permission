<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::get('/view-role/{id}', [RoleController::class, 'view'])->name('role.view');
    Route::get('/create-role', [RoleController::class, 'createRoleIndex'])->name('role.createForm');
    Route::post('/create-role', [RoleController::class, 'createRole'])->name('role.create');
    Route::get('/edit-role/{id}', [RoleController::class, 'editRoleIndex'])->name('role.editFrom');
    Route::post('/edit-role', [RoleController::class, 'editRole'])->name('role.edit');
    Route::get('/delete-role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');


    // Users Routes
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/view-user/{id}', [UserController::class, 'view'])->name('user.view');
    Route::get('/create-user', [UserController::class, 'createUserIndex'])->name('user.createForm');
    Route::post('/create-user', [UserController::class, 'createUser'])->name('user.create');
    Route::get('/edit-user/{id}', [UserController::class, 'editRoleIndex'])->name('user.editFrom');
    Route::post('/edit-user', [UserController::class, 'editUser'])->name('user.edit');
    Route::get('/delete-user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});
