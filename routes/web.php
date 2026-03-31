<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'home'])->name('index');

Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/search', [DashboardController::class, 'makeSearch'])->name('search');
Route::get('/library/index', [NoteController::class, 'index'])->name('library.index');

Route::get('/documents',          [DocumentController::class, 'index'])  ->name('documents.index');
Route::post('/documents',         [DocumentController::class, 'store'])  ->name('documents.store');
Route::delete('/documents/{id}',  [DocumentController::class, 'destroy'])->name('documents.destroy');

Route::post('/library/index', [NoteController::class, 'store'])->name('note.store');