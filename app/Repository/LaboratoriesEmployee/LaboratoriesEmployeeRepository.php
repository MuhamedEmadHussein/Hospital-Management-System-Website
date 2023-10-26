<?php

namespace App\Repository\LaboratoriesEmployee;
use App\Interfaces\LaboratoriesEmployee\LaboratoriesEmployeeRepositoryInterface;
use App\Models\LaboratoryEmployee;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class LaboratoriesEmployeeRepository implements LaboratoriesEmployeeRepositoryInterface{
    public function index(){
        $laboratorie_employees = LaboratoryEmployee::all();
        return view('Dashboard.lab_employee.index',compact('laboratorie_employees'));
        
    }

    public function store($request){
        try{
            LaboratoryEmployee::create([
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

    public function update($request, $id){
        try{
            $input = $request->all();
            
            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);

            }else{
                $input = Arr::except($input,['password']);

            }
            
            $lab_employee = LaboratoryEmployee::findOrFail($id);

            $lab_employee->update($input);

            session()->flash('edit');

            return redirect()->back();

        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    public function destroy($id){
        try{

            LaboratoryEmployee::destroy($id);

            session()->flash('delete');

            return redirect()->back();
            
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }
}
