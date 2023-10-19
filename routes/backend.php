<?php

use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Livewire\SingleInvoices;
use Illuminate\Support\Facades\Route;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('/Dashboard', [DashboardController::class,'index']);

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...

        //##################### Dashboard User #################################################
        Route::get('/dashboard/user', function () {
            return view('Dashboard.User.dashboard');
        })->middleware(['auth'])->name('dashboard.user');

        //##################### Dashboard Admin #################################################
        Route::get('/dashboard/admin', function () {
            return view('Dashboard.Admin.dashboard');
        })->middleware(['auth:admin'])->name('dashboard.admin');

        //###########################################################################################
        Route::middleware(['auth:admin'])->group(function(){

            Route::resource('categories', CategoryController::class);
            // Route::get('/admin/profile',[UserProfileController::class,'show'])->name('admin.profile.show');
            Route::resource('doctors', DoctorController::class);
            Route::resource('service',SingleServiceController::class);
            Route::resource('insurances',InsuranceController::class);
            Route::resource('Ambulance',AmbulanceController::class);
            Route::resource('Patients',PatientController::class);
            Route::resource('Receipt',ReceiptAccountController::class);
            Route::resource('Payment',PaymentAccountController::class);
            Route::post('update_password',[DoctorController::class,'update_password'])->name('update_password');
            Route::post('update_status',[DoctorController::class,'update_status'])->name('update_status');
            Route::view('Add_GroupServices','livewire.GroupServices.include_create')->name('Add_GroupServices');
            Route::view('single_invoices','livewire.single_invoices.index')->name('single_invoices');
            Route::view('Print_single_invoices','livewire.single_invoices.print')->name('Print_single_invoices');

        });

        require __DIR__.'/web.php';

    });
    
