<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\ScreeningController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // 🔥 PATIENT
    Route::get('/patients', [PatientController::class, 'index']);
    Route::post('/patients', [PatientController::class, 'store']);

    // 🔥 SCREENING
    Route::post('/screenings', [ScreeningController::class, 'store']);
    Route::get('/screenings', [ScreeningController::class, 'index']);

    // 🔥 MONITORING
    Route::get('/monitoring', [ScreeningController::class, 'monitoring']);
    Route::post('/monitoring/{id}', [ScreeningController::class, 'updateStatus']);
});