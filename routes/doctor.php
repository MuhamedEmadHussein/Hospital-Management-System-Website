<?php

use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\doctor\DiagnosticsController;
use App\Http\Controllers\doctor\InvoicesController;
use App\Http\Controllers\doctor\LaboratoriesController;
use App\Http\Controllers\doctor\PatientDetailsController;
use App\Http\Controllers\doctor\RaysController;
use App\Http\Controllers\LabEmployee\LabInvoicesController;
use App\Livewire\Chat\CreateChat;
use App\Livewire\Chat\Main;
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
                Route::get('/show/{id}',[RayEmployeeController::class,'show'])->name('ray_employee.show_file');
                Route::get('/lab/show/{id}',[LabInvoicesController::class,'viewLaboratories'])->name('viewLaboratoryFiles');
                Route::delete('/lab/delete/{$id}',[LabInvoicesController::class,'destroy'])->name('Laboratories.destroy');
                
                Route::resource('invoices',InvoicesController::class);
                Route::resource('Diagnostics',DiagnosticsController::class);
                Route::resource('rays',RaysController::class);
                Route::resource('Laboratories',LaboratoriesController::class);

                //##################### Route Chat #################################################
                
                Route::get('list/patients',CreateChat::class)->name('list.patients');
                Route::get('chat/patients',Main::class)->name('chat.patients');
      
                
            });
        });
       

        require __DIR__.'/web.php';

    });
    
