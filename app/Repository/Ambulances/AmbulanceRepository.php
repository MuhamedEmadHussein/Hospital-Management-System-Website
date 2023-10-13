<?php

namespace App\Repository\Ambulances;
use App\Interfaces\Ambulances\AmbulancesRepositoryInterface;
use App\Models\Ambulance;

class AmbulanceRepository implements AmbulancesRepositoryInterface{
    public function index(){
        $ambulances = Ambulance::all();
        return view('Dashboard.Ambulances.index',compact('ambulances'));

    }
    public function create(){
        return view('Dashboard.Ambulances.create');
    
    }

    public function store($request){
        try{
            Ambulance::create([
                'car_number' => $request->car_number,
                'car_model' => $request->car_model,
                'car_year_made' => $request->car_year_made,
                'driver_license_number' => $request->driver_license_number,
                'driver_phone' => $request->driver_phone,
                'is_available' => 1,
                'car_type' => $request->car_type,
                'driver_name' => $request->driver_name,
                'notes' => $request->notes ?? 'لا يوجد ملاحظة'
            ]);
   
            session()->flash('add');
            return redirect()->back();

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        
        }
    }

    public function edit($id){
        $ambulance = Ambulance::findOrFail($id);
        return view('Dashboard.Ambulances.edit',compact('ambulance'));

    }
    
    public function update($request){
        if($request->has('is_available')){
            $request->request->add(['is_available' =>1]);

        }else{
            $request->request->add(['is_available' =>2]);

        }

        try{
            $ambulance = Ambulance::findOrFail($request->id);
            $ambulance->update($request->all());

            $ambulance->driver_name = $request->driver_name;
            $ambulance->notes = $request->notes ?? 'لا يوجد ملاحظة';
            
            $ambulance->save();

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        
        }

        session()->flash('edit');
        return redirect()->back();

    }

    public function destroy($request){
        Ambulance::destroy($request->id);

        session()->flash('delete');
        return redirect()->back();
    }
}
