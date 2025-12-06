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
        Route::post('/profile/update', 'profile')->name('userProfile');
        Route::post('/password/change', 'changePassword')->name('userChangePassword');
    });

    Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('userKendaraan');
    Route::post('/kendaraan/search', [KendaraanController::class, 'search']);

    Route::controller(PinjamController::class)->group(function () {
        Route::get('/rental', 'index')->name('userPinjam');
        Route::get('/pinjam/book/{id}', 'book')->name('userPinjamBook');
        Route::delete('/pinjam/cancel/{id}', 'cancel')->name('rentalCancel');
    });
});