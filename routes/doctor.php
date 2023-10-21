<?php

use App\Http\Controllers\doctor\DiagnosticsController;
use App\Http\Controllers\doctor\InvoicesController;
use App\Http\Controllers\doctor\PatientDetailsController;
use App\Http\Controllers\doctor\RaysController;
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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...
        //##################### Dashboard Doctor #################################################
        Route::get('/dashboard/doctor', function () {
            return view('Dashboard.doctor.dashboard');
        })->middleware(['auth:doctor'])->name('dashboard.doctor');
        
        //###########################################################################################
        Route::prefix('doctor')->group(function(){
            
            Route::middleware(['auth:doctor'])->group(function(){

                Route::get('/reviewInvoices',[InvoicesController::class, 'reviewInvoices'])->name('reviewInvoices');
                Route::get('/completedInvoices',[InvoicesController::class, 'completedInvoices'])->name('completedInvoices');
                Route::post('/add_review',[DiagnosticsController::class,'addReview'])->name('add_review'); 
                Route::get('/patient_details/{id}',[PatientDetailsController::class,'index'])->name('patient_details');
                
                Route::resource('invoices',InvoicesController::class);
                Route::resource('Diagnostics',DiagnosticsController::class);
                Route::resource('rays',RaysController::class);



                
            });
        });
       

        require __DIR__.'/web.php';

    });
    
