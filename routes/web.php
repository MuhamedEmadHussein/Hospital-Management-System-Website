<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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
    return view('welcome');
});

//################################## Route User ##############################################

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');

Route::post('/user/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest')->name('login.user');

Route::post('/user/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout.user');

//################################## Route Admin ##############################################

Route::post('/login/admin', [AdminController::class, 'store'])->middleware('guest')->name('login.admin');

Route::post('/logout/admin', [AdminController::class, 'destroy'])->middleware('auth:admin')->name('logout.admin');
