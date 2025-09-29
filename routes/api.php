<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);

Route::middleware('auth:api')->group(function() {
    Route::post('logout', [AuthController::class,'logout']);

    // Patients
    Route::get('patients', [PatientController::class,'index']);
    Route::post('patients', [PatientController::class,'store']);
    Route::get('patients/{id}', [PatientController::class,'show']);
    Route::put('patients/{id}', [PatientController::class,'update']);
    Route::delete('patients/{id}', [PatientController::class,'destroy']);

    // Appointments
    Route::get('appointments', [AppointmentController::class,'index']);
    Route::post('appointments', [AppointmentController::class,'store']);
    Route::get('appointments/{id}', [AppointmentController::class,'show']);
    Route::put('appointments/{id}', [AppointmentController::class,'update']);
    Route::delete('appointments/{id}', [AppointmentController::class,'destroy']);
});
