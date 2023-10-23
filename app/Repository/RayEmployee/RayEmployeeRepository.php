<?php

namespace App\Repository\RayEmployee;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Models\Ray;
use App\Models\RayEmployee;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RayEmployeeRepository implements RayEmployeeRepositoryInterface{
    public function index(){
        $ray_employees = RayEmployee::all();
        return view('Dashboard.ray_employee.index',compact('ray_employees'));
        
    }

    public function showInvoices(){
        $invoices = Ray::all();
        return view('Dashboard.ray_employee.invoices.index',compact('invoices'));
           
    }
    public function store($request){
        try{

            RayEmployee::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            session()->flash('add');

            return redirect()->back();

        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    public function editRay($id){
        $invoice = Ray::findOrFail($id);
        return view('Dashboard.ray_employee.invoices.add_diagnosis',compact('invoice'));
    }

    public function addRayDiagnosis($request, $id){
        try{

           $ray = Ray::findOrFail($id);

           $ray->update([
                'employee_id' => Auth::user()->id,
                'description_employee' => $request->description_employee,
                'case' => 1
           ]);

           session()->flash('add');

            return redirect()->back();
            
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    public function update($request,$id){
        try{
            $input = $request->all();
            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);

            }else{
                $input = Arr::except($input,['password']);

            }  

            $ray_employee =RayEmployee::findOrFail($id);
            $ray_employee->update($input);
            
            session()->flash('edit');

            return redirect()->back();
            
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }
    public function destroy($id){
        try{
            RayEmployee::destroy($id);
            
            session()->flash('delete');

            return redirect()->back();

        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }
}
