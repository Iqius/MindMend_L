<?php
// routes/web.php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Patient\PatientController;

Route::get('/', function () {
    return view('index');
})->name('home');

// Routes untuk autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);

// Route untuk upload file
Route::post('/upload/file', [App\Http\Controllers\UploadController::class, 'upload'])->name('upload.file');

// Route untuk appointment dan settings (mungkin membutuhkan controller yang sesuai)
// Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.index');
// Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

// Group middleware auth untuk route patient
Route::middleware(['auth'])->prefix('patient')->group(function () {
    Route::get('/index', [PatientController::class, 'index'])->name('patient.index');
    Route::get('/doctors', [PatientController::class, 'doctors'])->name('patient.doctors');
    Route::get('/schedule', [PatientController::class, 'schedule'])->name('patient.schedule');
    Route::get('/search-schedule', [PatientController::class, 'searchSchedule'])->name('patient.searchSchedule');
    Route::get('/appointment', [PatientController::class, 'appointment'])->name('patient.appointment');
    Route::get('/setting', [PatientController::class, 'setting'])->name('patient.setting');
    // Tambahkan route lainnya sesuai kebutuhan
});

