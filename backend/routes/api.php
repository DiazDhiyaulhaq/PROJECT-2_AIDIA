<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\ScreeningController;

/*
|--------------------------------------------------------------------------
| API ROUTES
|--------------------------------------------------------------------------
*/

//
// 🔥 AUTH MOBILE
//
Route::post(
    '/register',
    [AuthController::class, 'register']
);

Route::post(
    '/login',
    [AuthController::class, 'login']
);

//
// 🔥 PROTECTED ROUTES
//
Route::middleware('auth:sanctum')
    ->group(function () {

    //
    // 🔥 AUTH USER
    //
    Route::get('/me',
        function (Request $request) {

        return $request->user();
    });

    Route::post(
        '/logout',
        [AuthController::class, 'logout']
    );

    //
    // 🔥 PATIENT
    //
    Route::get(
        '/patients',
        [PatientController::class, 'index']
    );

    Route::post(
        '/patients',
        [PatientController::class, 'store']
    );

    //
    // 🔥 SCREENING FULL
    //
    Route::get(
        '/screenings',
        [ScreeningController::class, 'index']
    );

    Route::post(
        '/screenings',
        [ScreeningController::class, 'store']
    );

    //
    // 🔥 QUICK GLUCOSE MOBILE
    //
    Route::post(
        '/glucose',
        [ScreeningController::class, 'storeGlucose']
    );

    //
    // 🔥 MONITORING
    //
    Route::get(
        '/monitoring',
        [ScreeningController::class, 'monitoring']
    );

    Route::post(
        '/monitoring/{id}',
        [ScreeningController::class, 'updateStatus']
    );

});