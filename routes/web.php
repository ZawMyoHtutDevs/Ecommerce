<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

// Admin
Route::group(['prefix' => 'dashboard', 'middleware' => 'admin'], function () {
    // User and Account
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'show_create_user'])->name('show.create.user');
    Route::post('/users/add', [UserController::class, 'create_user'])->name('create.user');
    
    // Delete User
    Route::post('/users/delete/{id}', [UserController::class, 'delete_user'])->name('delete.user');
    
});


// Staff
Route::group(['prefix' => 'dashboard', 'middleware' =>  'staff'], function () {
    
    // Edit User
    Route::get('user/{id}', [UserController::class, 'show'])->name('users.detail');
    
    
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('update.user');
    
    // change password
    Route::put('/change_password/{id}', [UserController::class, 'change_password'])->name('change.password');
    
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::post('upload_image',[BlogController::class, 'uploadImage'])->name('upload');
    
});

// Customer
Route::group(['prefix' => 'dashboard', 'middleware' => 'customer'], function () {
    
});

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
