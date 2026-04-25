<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ReminderController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login'); // Karena error log menunjukkan filemu di resources/views/auth/login.blade.php
})->name('login');

Route::get('/', function () {
    return redirect()->route('login');
});

// Rute POST ini yang dicari oleh action form! Pastikan ->name('login.post') ada.
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // 🔥 DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // 🔥 PATIENTS
    Route::get('/patients', [PatientController::class, 'index']);
    Route::get('/patients/create', [PatientController::class, 'create']);
    Route::post('/patients', [PatientController::class, 'store']);
    Route::get('/patients/{id}/edit', [PatientController::class, 'edit']);
    Route::put('/patients/{id}', [PatientController::class, 'update']);
    Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | 🔥 SCREENING (WIZARD FLOW)
    |--------------------------------------------------------------------------
    */

    // STEP 1 → langsung saat buka menu
    Route::get('/screenings', [ScreeningController::class, 'selectPatient']);

    // STEP 2
    Route::get('/screenings/form/{id}', [ScreeningController::class, 'form']);

    // PROCESS
    Route::post('/screenings/process', [ScreeningController::class, 'process']);

    // STEP 3 (RESULT)
    Route::get('/screenings/result/{id}', [ScreeningController::class, 'result']);

    /*
    |--------------------------------------------------------------------------
    | 🔥 SCREENING DATA (HISTORY)
    |--------------------------------------------------------------------------
    */

    // 🔥 SCREENING (CLEAN)
    Route::get('/screenings', [ScreeningController::class, 'index']);
    Route::get('/screenings/select', [ScreeningController::class, 'selectPatient']);
    Route::get('/screenings/form/{id}', [ScreeningController::class, 'form']);
    Route::post('/screenings/process', [ScreeningController::class, 'process']);
    Route::get('/screenings/result/{id}', [ScreeningController::class, 'result']);
    Route::get('/screenings/{id}/pdf', [ScreeningController::class, 'pdf']);

    // 🔥 MONITORING
    Route::get('/monitoring', [MonitoringController::class, 'index']);
    Route::get('/monitoring/{id}/{status}', [MonitoringController::class, 'updateStatus']);

    // 🔥 LAPORAN
    Route::get('/laporan', [DashboardController::class, 'laporan']);

    // 🔥 CHAT AI
    Route::get('/chat-ui', function () {
        return view('chat');
    });
    Route::post('/chat', [ChatbotController::class, 'chat']);

    // 🔥 USER MANAGEMENT
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // 🔥 EDUKASI
    Route::get('/edukasi', [EducationController::class, 'index']);
    Route::get('/edukasi/create', [EducationController::class, 'create']);
    Route::post('/edukasi', [EducationController::class, 'store']);

    // 🔥 REMINDER
    Route::get('/reminders', [ReminderController::class, 'index']);
    Route::get('/reminders/create', [ReminderController::class, 'create']);
    Route::post('/reminders', [ReminderController::class, 'store']);
});