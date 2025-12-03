<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// admin
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\UserController as adminUser;

// user
use App\Http\Controllers\UserController;

Route::middleware('guest')->group(function() {
    // welcome page
    Route::get('/', function(){return view('welcome');});

    // login dan daftar 
    Route::controller(AuthController::class)->group(function () {
        // login
        Route::get('/login', 'index')->name('login');
        Route::post('/cekLogin', 'cekLogin');
        
        // daftar
        Route::get('/daftar', 'daftar')->name('daftar');
        Route::post('/daftar', 'store');
    });
});

// logout
Route::get('/logout', [AuthController::class, 'logout']);

/*
    |--------------------------------------------------------------------------
    | route untuk auth yang dimana user_status adalah ADMIN
    |--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function() {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'index'])->name('adminDashboard');

            // admin: crud user
            Route::controller(adminUser::class)->group(function() {
                Route::get('/user',  'index')->name('adminUser');
                Route::post('/user/store',  'store');
                Route::get('/user/search/',  'search');
                Route::delete('/user/destroy/{id}',  'destroy')->name('admin.user.destroy');
                Route::post('/user/update',  'update');
            });
      });
    });


    /*
    |--------------------------------------------------------------------------
    | route untuk auth yang dimana user_status adalah USER
    |--------------------------------------------------------------------------
*/

    Route::middleware('user')->group(function() {
        Route::controller(UserController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('userDashboard');
    });
    });

});