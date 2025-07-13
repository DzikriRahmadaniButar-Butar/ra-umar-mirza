<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\SearchPaymentController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FeeCategoryController;
use App\Models\Fee;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/search-payment', [SearchPaymentController::class, 'show'])->name('search.payment');
Route::post('/search-payment', [SearchPaymentController::class, 'show'])->name('search.payment');


Route::get('/print/kartu/{student}', [PrintController::class, 'kartu'])->name('print.kartu-pembayaran');

    

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //settings
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/set-active-year', [SettingController::class, 'setActiveYear'])->name('settings.set-active-year');
        
    // web.php
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Students routes
    Route::resource('students', StudentController::class);
    Route::post('/students/bulk-delete', [StudentController::class, 'bulkDelete'])->name('students.bulk-delete');
    
    // controller
    Route::resource('payments', PaymentController::class);
    Route::resource('academic_years', AcademicYearController::class);
    Route::resource('classrooms', ClassroomController::class);

    //fee route
    Route::get('/fees', [FeeCategoryController::class, 'index'])->name('fees.index');
    
    //print kwitansi admin
    Route::get('/print/kwitansi/{studentId}/{paymentId?}', [PrintController::class, 'generateKwitansi'])->name('print.kwitansi');
    Route::get('/print/kwitansi-pdf/{studentId}/{paymentId?}', [PrintController::class, 'generateKwitansiPdf'])->name('print.kwitansi.pdf');
    Route::post('/print/kwitansi-multiple/{studentId}', [PrintController::class, 'generateKwitansiMultiple'])->name('print.kwitansi.multiple');
});

require __DIR__.'/auth.php';