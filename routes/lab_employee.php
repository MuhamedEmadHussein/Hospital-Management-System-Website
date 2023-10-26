<?php

use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\doctor\DiagnosticsController;
use App\Http\Controllers\doctor\InvoicesController;
use App\Http\Controllers\doctor\LaboratoriesController;
use App\Http\Controllers\doctor\PatientDetailsController;
use App\Http\Controllers\doctor\RaysController;
use App\Http\Controllers\LabEmployee\LabInvoicesController;
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
        
        //##################### Dashboard Lab Employee #################################################
          Route::get('/dashboard/lab_employee', function () {
            return view('Dashboard.lab_employee.dashboard');
        })->middleware(['auth:lab_employee'])->name('dashboard.lab_employee');
        
        Route::prefix('laboratory')->group(function(){
            
            Route::middleware(['auth:lab_employee'])->group(function(){

                Route::resource('lab_invoices',LabInvoicesController::class);
                Route::get('/completedInvoices',[LabInvoicesController::class,'completedInvoices'])->name('lab.completedInvoices');
                
            });
        });


    });
    
