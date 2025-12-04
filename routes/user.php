<?php

use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| route untuk auth yang dimana user_status adalah USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'user'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('userDashboard');
    });
});