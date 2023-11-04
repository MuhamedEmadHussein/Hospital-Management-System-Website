<?php

namespace App\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\Category;
use App\Models\Doctor;
use Livewire\Component;

class Create extends Component
{
    public $doctors;
    public $sections;
    public $doctor;
    public $section;
    public $name;
    public $email;
    public $phone;
    public $notes;
    public $appointment_patient;
    public $success_message= false;
    public $fail_message = false;
    public function mount(){

        $this->sections = Category::get();
        $this->doctors = collect();
  
      }
    public function render()
    {   
        return view('livewire.appointments.create',
        [
            'sections' => Category::get(),
         ]);
    }

    public function updatedSection($section_id){
        $this->doctors = Doctor::where('category_id',$section_id)->get();
   
    }
    public function store(){
       $doctor_appointment_count = Appointment::where('doctor_id', $this->doctor)->where('type','غير مؤكد')->where('appointment_patient', $this->appointment_patient)->count();
       $doctor_info = Doctor::findOrFail($this->doctor);
       
       if($doctor_appointment_count ==  $doctor_info->number_of_statements){
            $this->fail_message = true;
            return redirect()->back();
       } 
       
       Appointment::create([
            'doctor_id' => $this->doctor,
            'category_id' => $this->section,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'notes' => $this->notes,
            'appointment_patient' => $this->appointment_patient
        ]);
                   
        $this->success_message = true;
    }

}
