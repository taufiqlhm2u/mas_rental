<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// admin
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\UserController as adminUser;

// user
use App\Http\Controllers\UserController;


Route::controller(AuthController::class)->group(function () {
    // login
    Route::get('/', 'index');
    Route::get('/login', 'index')->name('login');
    Route::post('/cekLogin', 'cekLogin');
    Route::get('/logout', 'logout');

    // daftar
    Route::get('/daftar', 'daftar')->name('daftar');
    Route::post('/daftar', 'store');
});

// admin
Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function() {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'index'])->name('adminDashboard');

            // admin- crud user
            Route::get('/user', [adminUser::class, 'index'])->name('adminUser');
            Route::post('/user/store', [adminUser::class, 'store']);
            Route::get('/user/search/', [adminUser::class, 'search']);
            Route::delete('/user/destroy/{id}', [adminUser::class, 'destroy'])->name('admin.user.destroy');
      });
    });


    // user
    Route::middleware('user')->group(function() {
        Route::controller(UserController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('userDashboard');
    });
    });

});