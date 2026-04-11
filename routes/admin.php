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
    Route::get('/permissions', [DashboardController::class, 'permissions'])->name('permissions');
    Route::get('/fields', [DashboardController::class, 'fields'])->name('fields');
    Route::put('/permissions', [UserController::class, 'update'])->name('user.update');
    Route::delete('/permissions/{idHashed}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
});