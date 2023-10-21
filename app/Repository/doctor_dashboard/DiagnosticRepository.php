<?php 

namespace App\Repository\doctor_dashboard;
use App\Interfaces\doctor_dashboard\DiagnosticRepositoryInterface;
use App\Models\Diagnostic;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class DiagnosticRepository implements DiagnosticRepositoryInterface{

    public function store($request){
        DB::beginTransaction();
        try{
            Diagnostic::create([
                'date' => date('Y-m-d'),
                'diagnosis' => $request->diagnosis,
                'medicine' => $request->medicine,
                'invoice_id' => $request->invoice_id,
                'patient_id' => $request->patient_id,
                'doctor_id' => $request->doctor_id
            ]);

            $invoice_status = Invoice::findOrFail($request->invoice_id);
            $invoice_status->update([
                'invoice_status' => 3
            ]);

            DB::commit();
            
            session()->flash('add');

            return redirect()->back();

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    public function addReview($request){
        DB::beginTransaction();
        try{
            Diagnostic::create([
                'date' => date('Y-m-d'),
                'diagnosis' => $request->diagnosis,
                'medicine' => $request->medicine,
                'invoice_id' => $request->invoice_id,
                'patient_id' => $request->patient_id,
                'doctor_id' => $request->doctor_id,
                'review_date' => $request->review_date,
            ]);

            $invoice_status = Invoice::findOrFail($request->invoice_id);
            $invoice_status->update([
                'invoice_status' => 2
            ]);

            DB::commit();
            
            session()->flash('add');

            return redirect()->back();

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    public function show($id){
        $patient_records = Diagnostic::where('patient_id',$id)->get();
        return view('Dashboard.doctor.Invoices.patient_record',compact('patient_records'));


    }

}
