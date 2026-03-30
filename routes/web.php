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
Route::get('/notes/index', [NoteController::class, 'index'])->name('notes.index');
Route::post('/notes/index', [NoteController::class, 'store'])->name('images.store');