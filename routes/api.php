<?php

use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\DocumentController;
use App\Http\Controllers\Api\User\EmployeeController;
use App\Http\Controllers\Api\User\MyNoteController;
use App\Http\Controllers\Api\User\NoteController;
use App\Http\Controllers\Api\Admin\AdminAuthController;
use App\Http\Controllers\Api\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Api\Admin\UserController as AdminUserController;
use App\Http\Controllers\Api\Admin\JobTitleController;
use App\Http\Controllers\Api\Admin\AirlineController;
use App\Http\Controllers\Api\Admin\DocumentTypeController as AdminDocumentTypeController;
use App\Http\Controllers\Api\Admin\ManagementController;
use App\Http\Controllers\Api\Admin\NationalityController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('notes', NoteController::class);
    Route::apiResource('myNote', MyNoteController::class);
    Route::get('/employees/search', [EmployeeController::class, 'doSearch']);
    Route::apiResource('employees', EmployeeController::class);
    Route::get('/documents/employee/{employeeHash}', [DocumentController::class, 'show']);
    Route::get('/documents/{employeeHash}/{document_typeHash}', [DocumentController::class, 'showTypeFiles']);
    Route::get('/documents/{id}/preview', [DocumentController::class, 'officePreview']);
    Route::apiResource('documents', DocumentController::class)->except(['show']);
});

Route::prefix('admin')->group(function() {

    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware(['auth:admin-api', 'checkAdminApi'])->group(function() {
        Route::post('/logout', [AdminAuthController::class, 'logout']);

        Route::get('/permissions', [AdminDashboardController::class, 'permissions']);
        Route::get('/fields', [AdminDashboardController::class, 'fields']);
        Route::put('/users/update', [AdminUserController::class, 'update']);
        Route::delete('/users/{idHashed}', [AdminUserController::class, 'destroy']);

        Route::apiResource('job_title', JobTitleController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('airline', AirlineController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('document_type', AdminDocumentTypeController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('management', ManagementController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('nationality', NationalityController::class)->only(['store', 'update', 'destroy']);
    });
});