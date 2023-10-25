<?php

namespace App\Repository\RayEmployee;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Models\Ray;
use App\Models\RayEmployee;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RayEmployeeRepository implements RayEmployeeRepositoryInterface{

    use UploadImageTrait;
    public function index(){
        $ray_employees = RayEmployee::all();
        return view('Dashboard.ray_employee.index',compact('ray_employees'));
        
    }

    public function showInvoices(){
        $invoices = Ray::where('case',0)->get();
        return view('Dashboard.ray_employee.invoices.index',compact('invoices'));
           
    }
    public function showCompletedInvoices(){
        $invoices = Ray::where('case',1)->get();
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
        DB::beginTransaction();

        try{

            $ray = Ray::findOrFail($id);

            $ray->update([
                    'employee_id' => Auth::user()->id,
                    'description_employee' => $request->description_employee,
                    'case' => 1
            ]);

            if( $request->hasFile( 'photos' ) ) {

                foreach ($request->photos as $photo) {

                    $this->verifyAndStoreImageForeach($photo,'Rays','upload_image',$ray->id,'App\Models\Ray');

                }
    
            }
          
           DB::commit();

           session()->flash('add');

           return redirect()->route('ray_employee.invoices');
            
        }catch(\Exception $e){
            DB::rollBack();
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
    
    public function show($id){

        $ray = Ray::where('id', $id)
          ->where('doctor_id', Auth::user()->id)
          ->first();

        if ($ray != null) {
            return view('Dashboard.doctor.invoices.view_rays', compact('ray'));
        } else {
            return redirect()->route('404');
            
        }
        
    }
    public function viewRays($id){
        $ray = Ray::where('patient_id', $id)->where('employee_id', Auth::user()->id)->first();
        if($ray == null){
            return redirect()->route('404');
        }
        $rays = Ray::where('patient_id', $id)->where('employee_id', Auth::user()->id)->get();
        
        return view('Dashboard.ray_employee.invoices.patient_details', compact('ray','rays'));

    }
}
