<?php

namespace App\Repository\Patients;
use App\Interfaces\Patients\PatientsRepositoryInterface;
use App\Livewire\SingleInvoices;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use App\Models\Single_Invoice;
use Illuminate\Support\Facades\Hash;

class PatientRepository implements PatientsRepositoryInterface{

    public function index(){
        $Patients = Patient::all();
        return view('Dashboard.Patients.index',compact('Patients'));
    }

    public function show($id){
        $Patient = patient::findorfail($id);
        $invoices = Single_Invoice::where('patient_id', $id)->get();
        $receipt_accounts = ReceiptAccount::where('patient_id', $id)->get();
        $Patient_accounts = PatientAccount::where('patient_id', $id)->get();

        return view('Dashboard.Patients.show', compact('Patient', 'invoices', 'receipt_accounts', 'Patient_accounts'));
    }

    public function create(){
        return view('Dashboard.Patients.create');
    }

    public function store($request){
        try{

            Patient::create([
                'email' => $request->email,
                'password' => Hash::make($request->Phone),
                'Date_Birth' => $request->Date_Birth,
                'Phone' => $request->Phone,
                'Gender' => $request->Gender,
                'Blood_Group' => $request->Blood_Group,
                'name' => $request->name,
                'Address' => $request->Address
            ]);

            session()->flash('add');
            return redirect()->back();

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function edit($id){
        $Patient = Patient::findOrFail($id);
        return view('Dashboard.Patients.edit', compact('Patient'));

    }

    public function update($request){
        
        try{

            $patient = Patient::findOrFail($request->id);
            $patient->update([
                'email' => $request->email,
                'password' => Hash::make($request->Phone),
                'Date_Birth' => $request->Date_Birth,
                'Phone' => $request->Phone,
                'Gender' => $request->Gender,
                'Blood_Group' => $request->Blood_Group,
                'name' => $request->name,
                'Address' => $request->Address
            ]);
            
            $patient->save();

            session()->flash('edit');
            return redirect()->back();

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($request){
        Patient::destroy($request->id);
        
        session()->flash('delete');
        return redirect()->back();
    }
}
