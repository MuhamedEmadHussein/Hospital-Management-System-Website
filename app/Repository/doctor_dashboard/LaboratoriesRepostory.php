<?php

namespace App\Repository\doctor_dashboard;
use App\Interfaces\doctor_dashboard\LaboratoriesRepostoryInterface;
use App\Models\Laboratory;

class LaboratoriesRepostory implements LaboratoriesRepostoryInterface{
    public function store($request){
        try{
            Laboratory::create([
                'description' => $request->description, 
                'invoice_id' => $request->invoice_id,
                'patient_id' => $request->patient_id,
                'doctor_id' => $request->doctor_id
            ]);
            
            session()->flash('add');

            return redirect()->back();

        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }
    public function update($request,$id){
        try{
            $laboratory = Laboratory::findOrFail($id);

            $laboratory->update([
                'description' => $request->description, 
            ]);

            session()->flash('edit');

            return redirect()->back();
            
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }
    public function destroy($id){
        try{
            Laboratory::destroy($id);
            
            session()->flash('delete');

            return redirect()->back();

        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }
}
