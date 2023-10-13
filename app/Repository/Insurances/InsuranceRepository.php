<?php

namespace App\Repository\Insurances;

use App\Interfaces\Insurances\InsurancesRepositoryInterface;
use App\Models\Insurance;

class InsuranceRepository implements InsurancesRepositoryInterface{
    
    public function index(){
        $insurances = Insurance::all();
        return view('Dashboard.Insurances.index',compact('insurances'));
    }

    public function create(){
        return view('Dashboard.Insurances.create');
    }

    public function store($request){
        try{

            Insurance::create([
                'insurance_code'=> $request->insurance_code,
                'discount_percentage' => $request->discount_percentage,
                'Company_rate' => $request->Company_rate,
                'status' => 1,
                'name' => $request->name,
                'notes' => $request->notes ?? 'لا يوجد ملاحظة'
            ]);
           
            session()->flash('add');
            return redirect()->route('insurances.create');

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        
        }
    }
    
    public function edit($id){
        $insurance = Insurance::findOrFail($id);
        return view('Dashboard.Insurances.edit',compact('insurance'));
    }

    public function update($request){
        if($request->has('status')){
            $request->request->add(['status'=>1]);

        }else{
            $request->request->add(['status'=>0]);

        }
        try{
            $insurance = Insurance::findOrFail($request->id);
            $insurance->update($request->all());
            
            $insurance->name = $request->name;
            $insurance->notes = $request->notes ?? 'لا يوجد ملاحظة';
            
            $insurance->save();

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        
        }

        session()->flash('edit');
        return redirect()->route('insurances.index');
    }

    public function destroy($request){
        Insurance::destroy($request->id);
        
        session()->flash('delete');
        return redirect()->route('insurances.index');

    }

}
