<?php

use App\Http\Controllers\user\PinjamController;
use App\Http\Controllers\user\UserController as UserControll;
use App\Models\Kendaraan;
use App\Http\Controllers\user\KendaraanController;

/*
|--------------------------------------------------------------------------
| route untuk auth yang dimana user_status adalah USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'user'])->group(function () {
    Route::controller(UserControll::class)->group(function () {
        Route::get('/dashboard', 'index')->name('userDashboard');
        Route::get('/profile', 'profile')->name('userProfile');
    });

    Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('userKendaraan');
    Route::post('/kendaraan/search', [KendaraanController::class, 'search']);

    Route::controller(PinjamController::class)->group(function () {
        Route::get('/rental', 'index')->name('userPinjam');
        Route::post('/pinjam/store', 'store')->name('userPinjamStore');
        Route::get('/pinjam/{id}/show', 'show')->name('userPinjamShow');
    });
});