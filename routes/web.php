<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\DoctorController;
use App\Http\Controllers\Auth\LabEmployeeController;
use App\Http\Controllers\Auth\PatientController;
use App\Http\Controllers\Auth\RayEmployeeController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

//################################## Route User ##############################################

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');

Route::post('/user/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest')->name('login.user');

Route::post('/user/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout.user');

//################################## Route Admin ##############################################

Route::post('/login/admin', [AdminController::class, 'store'])->middleware('guest')->name('login.admin');

Route::post('/logout/admin', [AdminController::class, 'destroy'])->middleware('auth:admin')->name('logout.admin');

//################################## Route Doctor ##############################################
 
Route::post('/login/doctor', [DoctorController::class, 'store'])->middleware('guest')->name('login.doctor');

Route::post('/logout/doctor', [DoctorController::class, 'destroy'])->middleware('auth:doctor')->name('logout.doctor');

//################################## Route Ray Employee ##############################################
Route::post('/login/ray_employee', [RayEmployeeController::class, 'store'])->middleware('guest')->name('login.ray_employee');

Route::post('/logout/ray_employee', [RayEmployeeController::class, 'destroy'])->middleware('auth:ray_employee')->name('logout.ray_employee');

//################################## Route Lab Employee ##############################################
Route::post('/login/lab_employee', [LabEmployeeController::class, 'store'])->middleware('guest')->name('login.lab_employee');

Route::post('/logout/lab_employee', [LabEmployeeController::class, 'destroy'])->middleware('auth:lab_employee')->name('logout.lab_employee');

//################################## Route Patient ##############################################
Route::post('/login/patient', [PatientController::class, 'store'])->middleware('guest')->name('login.patient');

Route::post('/logout/patient', [PatientController::class, 'destroy'])->middleware('auth:patient')->name('logout.patient');
