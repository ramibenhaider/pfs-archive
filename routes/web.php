<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DocumentTypeController;
use App\Http\Controllers\User\DocumentController;
use App\Http\Controllers\User\EmployeeController;
use App\Http\Controllers\User\MyNoteController;
use App\Http\Controllers\User\NoteController;
use App\Http\Controllers\User\UserLoginController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function() {

    Route::get('/user/unactivated', function() {return view('user.unactivated');})->name('user.unactivated');

    Route::post('/logout', [UserLoginController::class, 'logout'])->name('user.logout');

    Route::middleware('guest:web')->group(function () {
        Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [UserLoginController::class, 'login'])->name('user.doLogin');
        Route::get('/user/registerUser', function() {return view('user.registerUser');})->name('user.register');
        Route::post('/user/login', [DashboardController::class, 'store'])->name('user.store');
    });

    Route::get('documents/office-view/{id}', [DocumentController::class, 'officePreview'])
        ->name('documents.office.preview')
        ->middleware('signed');

    Route::middleware(['auth:web', 'prevent-back', 'user-activation'])->group(function () {

        Route::resource('documents', DocumentController::class)->except('create');
        Route::get('documents/{employeeHash}/edit/{document_typeHash}', [DocumentController::class, 'showTypeFiles'])
             ->name('documents.showTypeFiles');
             
        Route::resource('employee', EmployeeController::class)->except(['destroy', 'show', 'index']);
        Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('employee/idex', [EmployeeController::class, 'doSearch'])->name('employee.search');

        Route::resource('note', NoteController::class)->except(['create', 'show']);

        Route::resource('myNote', MyNoteController::class)->except(['index', 'show']);
        
    });
});


