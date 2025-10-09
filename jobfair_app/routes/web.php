<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;

Route::get('/', [ApplicantController::class, 'create'])->name('applicant.create');
Route::post('/apply', [ApplicantController::class, 'store'])->name('applicant.store');
Route::get('/qr/{uuid}', [ApplicantController::class, 'showQr'])->name('qr.show');
Route::get('/applicant/{uuid}', [ApplicantController::class, 'show'])->name('applicant.show');
Route::post('/lookup', [ApplicantController::class, 'lookup'])->name('applicant.lookup');