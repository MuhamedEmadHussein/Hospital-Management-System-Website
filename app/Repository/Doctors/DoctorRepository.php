<?php

namespace App\Repository\Doctors;
use App\Interfaces\Doctors\DoctorsRepositoryInterface;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Doctor;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorRepository implements DoctorsRepositoryInterface{
    use UploadImageTrait;

    public function index(){
        $doctors = Doctor::with('doctors_appointments_pivot')->get();
        // $doctors = Doctor::all(); (worked)

        return view('Dashboard.Doctors.index',compact('doctors'));
    }

    public function create(){
        $categories = Category::all();
        $appointments = Appointment::all();
        return view('Dashboard.Doctors.add',compact('categories','appointments'));
    }
    public function store($request){
        DB::beginTransaction();

        try {

            $doctors = new Doctor();
            $doctors->email = $request->email;
            $doctors->password = Hash::make($request->password);
            $doctors->category_id = $request->section_id;
            $doctors->phone = $request->phone;
            // $doctors->price = $request->price;
            $doctors->status = 1;
            $doctors->save();

            // store trans
            $doctors->name = $request->name;
            // $doctors->appointments = implode(',',$request->appointments);
            $doctors->save();

            // insert pivot tABLE
            $doctors->doctors_appointments_pivot()->attach($request->appointments);
              
            //Upload img
            $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$doctors->id,'App\Models\Doctor');

            DB::commit();
            session()->flash('add');
            return redirect()->route('doctors.create');
  
          }

            catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
    }

    public function edit($id){
        $categories = Category::all();
        $appointments = Appointment::all();
        $doctor = Doctor::findOrFail($id);

        return view('Dashboard.Doctors.edit',compact('categories','appointments','doctor'));

    }
    
    public function update($request){
        DB::beginTransaction();

        try {

            $doctor = Doctor::findorfail($request->id);

            $doctor->email = $request->email;
            $doctor->category_id = $request->section_id;
            $doctor->phone = $request->phone;
            $doctor->save();
            // store trans
            $doctor->name = $request->name;
            $doctor->save();

            // update pivot tABLE
            $doctor->doctors_appointments_pivot()->sync($request->appointments);

            // update photo
            if ($request->has('photo')){
                // Delete old photo
                if ($doctor->image){
                    $old_img = $doctor->image->filename;
                    $this->Delete_attachment('upload_image','doctors/'.$old_img,$doctor->image->id);
                }
                //Upload img
                $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$request->id,'App\Models\Doctor');
            }

            DB::commit();
            session()->flash('edit');
            return redirect()->back();

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request){
        if($request->page_id == 1){
            $doctor = Doctor::findOrFail($request->id);

            if($request->filename){
                $this->Delete_attachment('upload_image','/doctors/'.$request->filename,$doctor->image->id);

            }
            $doctor->delete();
            session()->flash('delete');

            return redirect()->route('doctors.index');

        }else{

            $doctor_ids = explode(',',$request->delete_select_id);
      foreach($doctor_ids as $doctor_id){
                $doctor = Doctor::findOrFail($doctor_id);
                if($doctor->image){
                    $this->Delete_attachment('upload_image','/doctors/'.$doctor->image->filename,$doctor->image->id);
                }    
            }

            Doctor::destroy($doctor_ids);
            session()->flash('delete');

            return redirect()->route('doctors.index');

        }
    }

    public function update_password($request)
    {
        try {
            $doctor = Doctor::findorfail($request->id);
            $doctor->update([
                'password'=>Hash::make($request->password)
            ]);

            session()->flash('edit');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update_status($request)
    {
        try {
            $doctor = Doctor::findorfail($request->id);
            $doctor->update([
                'status'=>$request->status
            ]);

            session()->flash('edit');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
