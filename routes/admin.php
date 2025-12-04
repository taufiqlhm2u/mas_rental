<?php
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\UserController as adminUser;
use App\Http\Controllers\admin\KendaraanController as adminKendaraan;


/*
    |--------------------------------------------------------------------------
    | route untuk auth yang dimana user_status adalah ADMIN
    |--------------------------------------------------------------------------
*/


Route::middleware(['auth', 'admin'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('adminDashboard');

        // admin: crud user
        Route::controller(adminUser::class)->group(function () {
            Route::get('/user', 'index')->name('adminUser');
            Route::post('/user/store', 'store');
            Route::get('/user/search/', 'search');
            Route::delete('/user/destroy/{id}', 'destroy')->name('admin.user.destroy');
            Route::post('/user/update', 'update');
        });

        // admin: crud kendaraan
        Route::controller(adminKendaraan::class)->group(function () {
            Route::get('/kendaraan', 'index')->name('adminKendaraan');
            Route::post('/kendaraan/store', 'store');
            Route::get('/kendaraan/search/', 'search');
            Route::delete('/kendaraan/destroy/{id}', 'destroy')->name('admin.kendaraan.destroy');
            Route::post('/kendaraan/update', 'update');
        });
    });

});