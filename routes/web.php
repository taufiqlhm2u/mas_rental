<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


// masalah autentikasi
Route::middleware('guest')->group(function () {
    // welcome page
    Route::get('/', function () {
        return redirect('/login'); });

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

// route untuk auth yang dimana user_status adalah ADMIN
require __DIR__ . '/admin.php';

// route untuk auth yang dimana user_status adalah USER
require __DIR__ . '/user.php';



