<?php

use App\Events\MyEvent;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\LaboratoryEmployeeController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Livewire\SingleInvoices;
use Illuminate\Support\Facades\Auth;
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

            $data['single_service'] = \App\Models\Service::count();
            $data['group_service'] = \App\Models\Group::count();
            $data['doctors'] = \App\Models\Doctor::count();
            // $data['patients'] = \App\Models\Invoice::where('doctor_id',Auth::user()->id)->distinct('patient_id')->count();
            // $data['total'] = \App\Models\Invoice::where('doctor_id',Auth::user()->id)->sum('total_with_tax');
            // $data['invoices'] = \App\Models\Invoice::where('doctor_id',Auth::user()->id)->count();

            $data['patients'] = \App\Models\Invoice::count();            
            $data['total'] = \App\Models\Invoice::sum('total_with_tax');
            $data['invoices'] = \App\Models\Invoice::count();

            return view('Dashboard.Admin.dashboard',$data);
        })->middleware(['auth:admin'])->name('dashboard.admin');

        //##################### Dashboard Ray Employee #################################################
        Route::get('/dashboard/ray_employee', function () {
            return view('Dashboard.ray_employee.dashboard');
        })->middleware(['auth:ray_employee'])->name('dashboard.ray_employee');
        
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
            Route::resource('ray_employee',RayEmployeeController::class);
            Route::resource('lab_employee',LaboratoryEmployeeController::class);
            
            Route::post('update_password',[DoctorController::class,'update_password'])->name('update_password');
            Route::post('update_status',[DoctorController::class,'update_status'])->name('update_status');
            
            Route::view('Add_GroupServices','livewire.GroupServices.include_create')->name('Add_GroupServices');
            Route::view('single_invoices','livewire.single_invoices.index')->name('single_invoices');
            Route::view('Print_single_invoices','livewire.single_invoices.print')->name('Print_single_invoices');
            Route::view('group_invoices','livewire.group_invoices.index')->name('group_invoices');
            Route::view('group_Print_single_invoices','livewire.group_invoices.print')->name('group_Print_single_invoices');
            
            
        });

        Route::prefix('rays')->group(function(){
        
            Route::middleware(['auth:ray_employee'])->group(function(){
                Route::get('/addDiagnosis/{id}',[RayEmployeeController::class,'editRay'])->name('ray_employee.edit');
                Route::get('/invoices',[RayEmployeeController::class,'showInvoices'])->name('ray_employee.invoices');
                Route::get('/invoices/completed',[RayEmployeeController::class,'showCompletedInvoices'])->name('ray_employee.completedInvoices');
                Route::put('/add_ray_diagnosis/{id}',[RayEmployeeController::class,'addRayDiagnosis'])->name('ray_employee.add_ray_diagnosis');
                Route::get('/view_rays/{id}',[RayEmployeeController::class,'viewRays'])->name('view_rays');

        
            });
        });
        Route::get('/404', function () {
            return view('Dashboard.404');
        })->name('404');       
        require __DIR__.'/web.php';

    });
    
