<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

Route::middleware('guest.admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('doLogin');
});

Route::middleware('auth.admin')->group(function () {       
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::get('/registerationRequests',[UserController::Class, 'showRequests'])->name('showRequests');      
});