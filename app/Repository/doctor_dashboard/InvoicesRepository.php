<?php

namespace App\Repository\doctor_dashboard;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoicesRepository implements InvoicesRepositoryInterface{

    public function index(){
        $invoices = Invoice::where('doctor_id',Auth::user()->id)->get(); 
    
        return view('Dashboard.doctor.Invoices.index',compact('invoices'));
    }

}
