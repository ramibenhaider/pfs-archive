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
        Route::post('/login', [UserLoginController::class, 'login'])->name('doLogin');
    });

    Route::middleware('auth:web')->group(function () {
        Route::get('/', [DashboardController::class, 'home'])->name('index');
        Route::get('/search', [DashboardController::class, 'makeSearch'])->name('search');

        Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::post('/', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('/employee/show/{employee}', [EmployeeController::class, 'show'])->name('employee.show');
        Route::put('/employee/show/{employee}', [EmployeeController::class, 'update'])->name('employee.update');

        Route::get('/library/index', [NoteController::class, 'index'])->name('library.index');

        Route::get('/documents', [DocumentController::class, 'index'])  ->name('documents.index');
        Route::post('/documents', [DocumentController::class, 'store'])  ->name('documents.store');
        Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');
        Route::put('/library/document/{document}/show', [DocumentController::class, 'update'])->name('documents.update');
        Route::get('/library/documents/{employee}/show', [DocumentController::class, 'show'])->name('documents.show');

        Route::get('/library/document/{employee}/{document_type}/show', [DocumentTypeController::Class, 'show'])->name('documentType.show');

        Route::post('/library/index', [NoteController::class, 'store'])->name('note.store');
        Route::delete('/library/index/{id}', [NoteController::class, 'destroy'])->name('note.destroy');
        Route::get('/library/note/{note}/edit', [NoteController::class, 'edit'])->name('note.edit');
        Route::put('/library/note/{note}/edit', [NoteController::class, 'update'])->name('note.update');
        Route::get('/search-notes', [NoteController::class, 'doSearch'])->name('search_notes');
    });
});


