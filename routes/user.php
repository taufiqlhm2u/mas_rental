<?php

use App\Http\Controllers\user\PinjamController;
use App\Http\Controllers\user\UserController as UserControll;

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

    Route::get('/kendaraan', function () {
        return view('user.kendaraan');
    })->name('userKendaraan');

    Route::controller(PinjamController::class)->group(function () {
        Route::get('/pinjam', 'index')->name('userPinjam');
        Route::post('/pinjam/store', 'store')->name('userPinjamStore');
        Route::get('/pinjam/{id}/show', 'show')->name('userPinjamShow');
    });
});