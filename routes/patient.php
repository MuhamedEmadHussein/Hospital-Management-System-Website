<?php

use App\Http\Controllers\Patient\PatientController;
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
        
     //##################### Dashboard Patient #################################################
        Route::get('/dashboard/patient', function () {
            return view('Dashboard.Patients.dashboard');
        })->middleware(['auth:patient'])->name('dashboard.patient');

        //##################### Route Patient #################################################
        
        Route::prefix('patient')->group(function(){
            
            Route::middleware(['auth:patient'])->group(function(){
                
                Route::get('/invoices',[PatientController::class,'invoices'])->name('patient.invoices');
                Route::get('/laboratories',[PatientController::class,'laboratories'])->name('patient.laboratories');
                Route::get('/rays',[PatientController::class,'rays'])->name('patient.rays');
                Route::get('/payments',[PatientController::class,'payments'])->name('patient.payments');
                Route::get('/laboratories/view/{id}',[PatientController::class,'view_laboratories'])->name('laboratories.view');
                Route::get('/rays/view/{id}',[PatientController::class,'view_rays'])->name('rays.view');
               
            //##################### Route Chat #################################################
                
                Route::get('list/doctors',CreateChat::class)->name('list.doctors');
                Route::get('chat/doctors',Main::class)->name('chat.doctors');

            });
        });

    });
    
