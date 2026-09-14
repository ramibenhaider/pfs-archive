<?php

use App\Http\Controllers\Admin\JobTitleController;
use App\Http\Controllers\Admin\NationalityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyDocumentTypeController;


Route::middleware(['auth.admin', 'prevent-back'])->group(function () {       
    Route::get('/permissions', [DashboardController::class, 'permissions'])->name('permissions');
    Route::get('/fields', [DashboardController::class, 'fields'])->name('fields');
    Route::put('/permissions', [UserController::class, 'update'])->name('user.update');
    Route::delete('/permissions/{idHashed}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::resource('company', CompanyController::class)->only(['store', 'update', 'destroy']);
    Route::resource('document_type', DocumentTypeController::class)->only(['store', 'update', 'destroy']);
    Route::resource('company_document_type', CompanyDocumentTypeController::class)->only(['store', 'update', 'destroy']);
    Route::resource('management', ManagementController::class)->only(['store', 'update', 'destroy']);
    Route::resource('nationality', NationalityController::class)->only(['store', 'update', 'destroy']);
    Route::resource('job_title', JobTitleController::class)->only(['store', 'update', 'destroy']);


});