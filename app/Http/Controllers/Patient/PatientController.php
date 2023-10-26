<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Laboratory;
use App\Models\Ray;
use App\Models\ReceiptAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    //
    public function invoices(){
        $invoices = Invoice::where('patient_id',Auth::user()->id)->get();
        return view('Dashboard.Patients.invoices',compact('invoices'));
    }

    public function laboratories(){
        $laboratories = Laboratory::where('patient_id',Auth::user()->id)->get();
        return view('Dashboard.Patients.laboratories',compact('laboratories'));
    }

    public function rays(){
        $rays = Ray::where('patient_id',Auth::user()->id)->get();
        return view('Dashboard.Patients.rays',compact('rays'));
    }

    public function payments(){
        $payments = ReceiptAccount::where('patient_id',Auth::user()->id)->get();
        return view('Dashboard.Patients.payments',compact('payments'));
    }

    public function view_laboratories($id){
        $lab = Laboratory::where('id', $id)->where('patient_id',Auth::user()->id)->first();
        
        if($lab == null){
            return redirect()->route('404');
        }

        return view('Dashboard.lab_employee.invoices.view_labs', compact('lab'));

    }
    
    public function view_rays($id){
        
        $ray = Ray::where('id', $id)->where('patient_id',Auth::user()->id)->first();

        if ($ray != null) {
            return view('Dashboard.doctor.invoices.view_rays', compact('ray'));
        } else {
            return redirect()->route('404');
            
        }
    }
}
