<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\RegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/register', [RegistrationController::class, 'createForm'])->name('register.form');
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');
Route::get('/', [RegistrationController::class, 'index'])->name('index');


Route::get('/registrasi', [RegistrationController::class, 'createFormep'])->name('registrasi.formep');
Route::post('/registrasip', [RegistrationController::class, 'registerasi'])->name('registrasip.submit');

Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{id}/info', [RegistrationController::class, 'shows'])->name('events.info');

Route::post('/validate-attendance', [RegistrationController::class, 'validateAttendance']);

Route::get('/events/{id}/peserta', [RegistrationController::class, 'peserta'])->name('events.peserta');

// Route::post('/decode', [BarcodeController::class, 'decode']);