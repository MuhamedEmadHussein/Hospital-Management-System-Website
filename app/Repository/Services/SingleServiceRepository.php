<?php

namespace App\Repository\Services;
use App\Interfaces\Services\SingleServicesRepositoryInterface;
use App\Models\Service;

class SingleServiceRepository implements SingleServicesRepositoryInterface{
 
    public function index(){
        $services = Service::all();
        return view('Dashboard.Services.Single Service.index',compact('services'));
    }

    public function store($request){
        try{
            Service::create([
                'price' => $request->price,
                'description' => $request->description ?? 'لا يوجد ملاحظة',
                'status' => 1,
                'name' => $request->name,
            ]);
            
            session()->flash('add');
            return redirect()->route('service.index');

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request){
        try{            
            Service::findOrFail($request->id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'status' => $request->status
            ]);

            session()->flash('edit');
            return redirect()->route('service.index');

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request){
        $id = $request->id;
        Service::findOrFail($id)->delete();

        session()->flash('delete');
        return redirect()->route('service.index');
    }
}
