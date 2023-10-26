<?php

namespace App\Repository\LaboratoriesEmployee\Invoices;

use App\Interfaces\LaboratoriesEmployee\Invoices\LabEmployeeInvoicesRepositoryInterface;
use App\Models\Laboratory;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LabEmployeeInvoicesRepository implements LabEmployeeInvoicesRepositoryInterface
{
    use UploadImageTrait;

    public function index(){
        $invoices = Laboratory::where('case',0)->get();
        return view('Dashboard.lab_employee.invoices.index',compact('invoices'));
    
    }
    public function completedInvoices(){
        $invoices = Laboratory::where('case',1)->where('employee_id',Auth::user()->id)->get();
        return view('Dashboard.lab_employee.invoices.completed_invoices',compact('invoices'));
    
    }
    public function edit($id){
        $invoice = Laboratory::findOrFail($id);
        return view('Dashboard.lab_employee.invoices.add_diagnosis',compact('invoice'));
        
    }
    public function update($request, $id){

        DB::beginTransaction();

        try{

            $lab = Laboratory::findOrFail($id);

            $lab->update([
                    'employee_id' => Auth::user()->id,
                    'description_employee' => $request->description_employee,
                    'case' => 1
            ]);

            if( $request->hasFile( 'photos' ) ) {

                foreach ($request->photos as $photo) {

                    $this->verifyAndStoreImageForeach($photo,'labs','upload_image',$lab->id,'App\Models\Laboratory');

                }
    
            }
          
           DB::commit();

           session()->flash('add');

           return redirect()->route('lab_invoices.index');
            
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
        
    }
    public function show($id){
        
        $lab = Laboratory::where('id', $id)
        ->where('employee_id', Auth::user()->id)
        ->first();

      if ($lab != null) {
          return view('Dashboard.lab_employee.invoices.view_labs', compact('lab'));
      } else {
          return redirect()->route('404');
          
      }
    }
    public function viewLaboratories($id){
        
        $lab = Laboratory::where('id', $id)->first();
        
        if($lab == null){
            return redirect()->route('404');
        }

        return view('Dashboard.lab_employee.invoices.view_labs', compact('lab'));

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
