<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobApplicationController;

Route::get('/', [JobApplicationController::class, 'index'])->name('job-applications.index');
Route::get('/lamaran/tambah', [JobApplicationController::class, 'create'])->name('job-applications.create');
Route::post('/lamaran', [JobApplicationController::class, 'store'])->name('job-applications.store');
Route::get('/lamaran/{jobApplication}/edit', [JobApplicationController::class, 'edit'])->name('job-applications.edit');
Route::put('/lamaran/{jobApplication}', [JobApplicationController::class, 'update'])->name('job-applications.update');
Route::delete('/lamaran/{jobApplication}', [JobApplicationController::class, 'destroy'])->name('job-applications.destroy');
