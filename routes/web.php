<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DocumentTypeController;
use App\Http\Controllers\User\DocumentController;
use App\Http\Controllers\User\EmployeeController;
use App\Http\Controllers\User\NoteController;
use App\Http\Controllers\User\UserLoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function() {

    Route::middleware('guest:web')->group(function () {
        Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [UserLoginController::class, 'login'])->name('user.doLogin');
        Route::get('/user/registerUser', [DashboardController::class, 'register'])->name('user.register');
        Route::post('/user/login', [DashboardController::class, 'store'])->name('user.store');
    });

    Route::middleware(['auth:web', 'prevent-back'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('user.employee.index');
        Route::get('/search', [DashboardController::class, 'makeSearch'])->name('user.search');

        Route::get('/employee/create', [EmployeeController::class, 'create'])->name('user.employee.create');
        Route::post('/', [EmployeeController::class, 'store'])->name('user.employee.store');
        Route::get('/employee/show/{employeeHash}', [EmployeeController::class, 'show'])->name('user.employee.show');
        Route::put('/employee/show/{employee}', [EmployeeController::class, 'update'])->name('user.employee.update');

        Route::get('/library/index', [NoteController::class, 'index'])->name('user.library.index');

        Route::get('/documents', [DocumentController::class, 'index'])->name('user.documents.index');
        Route::post('/documents', [DocumentController::class, 'store'])->name('user.documents.store');
        Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('user.documents.destroy');
        Route::put('/library/document/{document}/show', [DocumentController::class, 'update'])->name('user.documents.update');
        Route::get('/library/documents/{employeeHash}/show', [DocumentController::class, 'show'])->name('user.documents.show');

        Route::get('/library/document/{employeeHash}/{document_typeHash}/show', [DocumentTypeController::Class, 'show'])->name('user.documentType.show');

        Route::post('/library/index', [NoteController::class, 'store'])->name('user.note.store');
        Route::delete('/library/index/{id}', [NoteController::class, 'destroy'])->name('user.note.destroy');
        Route::get('/library/note/{noteHash}/edit', [NoteController::class, 'edit'])->name('user.note.edit');
        Route::put('/library/note/{note}/edit', [NoteController::class, 'update'])->name('user.note.update');
        Route::get('/search-notes', [NoteController::class, 'doSearch'])->name('user.search_notes');

        Route::post('/logout', [UserLoginController::class, 'logout'])->name('user.logout');
    });
});


