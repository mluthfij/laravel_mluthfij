<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('hospitals.index');
    }
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // returns the home page with all hospitals
    Route::get('/hospitals/index', HospitalController::class .'@index')->name('hospitals.index');
    // returns the form for adding a hospital
    Route::get('/hospitals/create', HospitalController::class . '@create')->name('hospitals.create');
    // adds a hospital to the database
    Route::post('/hospitals', HospitalController::class .'@store')->name('hospitals.store');
    // returns a page that shows a full hospital
    Route::get('/hospitals/{hospital}', HospitalController::class .'@show')->name('hospitals.show');
    // returns the form for editing a hospital
    Route::get('/hospitals/{hospital}/edit', HospitalController::class .'@edit')->name('hospitals.edit');
    // updates a hospital
    Route::put('/hospitals/{hospital}', HospitalController::class .'@update')->name('hospitals.update');
    // deletes a hospital
    Route::delete('/hospitals/{hospital}', HospitalController::class .'@destroy')->name('hospitals.destroy');
});

Route::middleware('auth')->group(function () {
    // returns the home page with all patients
    Route::get('/patients/index', PatientController::class .'@index')->name('patients.index');
    // returns the form for adding a patient
    Route::get('/patients/create', PatientController::class . '@create')->name('patients.create');
    // adds a patient to the database
    Route::post('/patients', PatientController::class .'@store')->name('patients.store');
    // returns a page that shows a full patient
    Route::get('/patients/{patient}', PatientController::class .'@show')->name('patients.show');
    // returns the form for editing a patient
    Route::get('/patients/{patient}/edit', PatientController::class .'@edit')->name('patients.edit');
    // updates a patient
    Route::put('/patients/{patient}', PatientController::class .'@update')->name('patients.update');
    // deletes a patient
    Route::delete('/patients/{patient}', PatientController::class .'@destroy')->name('patients.destroy');
});

require __DIR__.'/auth.php';

// Error routes
Route::get('/404', [ErrorController::class, 'notFound'])->name('error.404');
Route::get('/500', [ErrorController::class, 'serverError'])->name('error.500');
Route::get('/403', [ErrorController::class, 'forbidden'])->name('error.403');

// Fallback route for any unmatched URLs - redirect to main page
Route::fallback(function () {
    return redirect()->route('hospitals.index')->with('error', 'Halaman yang Anda cari tidak ditemukan.');
});
