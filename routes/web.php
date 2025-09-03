<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HospitalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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

require __DIR__.'/auth.php';
