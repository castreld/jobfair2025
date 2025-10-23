<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\AdminApplicantController;

Route::get('/', [ApplicantController::class, 'create'])->name('applicant.create');
Route::post('/apply', [ApplicantController::class, 'store'])->name('applicant.store');
Route::get('/qr/{uuid}', [ApplicantController::class, 'showQr'])->name('qr.show');
Route::get('/applicant/{uuid}', [ApplicantController::class, 'show'])->name('applicant.show');
Route::post('/lookup', [ApplicantController::class, 'lookup'])->name('applicant.lookup');
Route::get('/positions/{company}', [ApplicantController::class, 'fetchPositions'])->name('positions.fetch');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login']);
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::resource('companies', CompanyController::class);

        Route::resource('companies.positions', PositionController::class)
        ->scoped([
            'position' => 'id',
        ])->except(['show']);
        
        Route::prefix('applicants')->name('applicants.')->group(function () {
            
            Route::get('/', [AdminApplicantController::class, 'index'])->name('index');
            Route::get('/trashed', [AdminApplicantController::class, 'trashed'])->name('trashed');
            Route::post('/trashed/{id}/restore', [AdminApplicantController::class, 'restore'])->name('restore');
            Route::delete('/trashed/{id}/force-delete', [AdminApplicantController::class, 'forceDelete'])->name('forceDelete');
            
            Route::get('/{applicant}', [AdminApplicantController::class, 'show'])->name('show');
            Route::delete('/{applicant}', [AdminApplicantController::class, 'destroy'])->name('destroy');
        });
    });
});