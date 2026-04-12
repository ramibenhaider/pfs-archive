<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DocumentTypeController;
use App\Http\Controllers\User\DocumentController;
use App\Http\Controllers\User\EmployeeController;
use App\Http\Controllers\User\NoteController;
use App\Http\Controllers\User\UserLoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function() {

    Route::get('/user/unactivated', function() {return view('user.unactivated');})->name('user.unactivated');

    Route::middleware('guest:web')->group(function () {
        Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [UserLoginController::class, 'login'])->name('user.doLogin');
        Route::get('/user/registerUser', function() {return view('user.registerUser');})->name('user.register');
        Route::post('/user/login', [DashboardController::class, 'store'])->name('user.store');
    });

    Route::middleware(['auth:web', 'prevent-back', 'user-activation'])->group(function () {

        Route::resource('documents', DocumentController::class)->except('create');
        Route::get('documents/{employeeHash}/edit/{document_typeHash}', [DocumentController::class, 'showTypeFiles'])->name('documents.showTypeFiles');

        Route::resource('employee', EmployeeController::class)->except(['destroy', 'show']);
        Route::get('employee/idex', [EmployeeController::class, 'doSearch'])->name('employee.search');

        Route::resource('note', NoteController::class)->except(['create', 'show']);
        Route::get('library/index', [NoteController::class, 'doSearch'])->name('note.search');

        Route::post('/logout', [UserLoginController::class, 'logout'])->name('user.logout');
        
    });
});


