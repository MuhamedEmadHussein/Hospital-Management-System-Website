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
    public $message= false;
    
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

       Appointment::create([
            'doctor_id' => $this->doctor,
            'category_id' => $this->section,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'notes' => $this->notes,
        ]);
      
             
        $this->message = true;
    }

}
