<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $doctors = Doctor::factory()->count(30)->create();

        $appointments = Appointment::all();

        Doctor::all()->each(function($doctor) use($appointments) {
            $doctor->doctors_appointments_pivot()->attach(
                $appointments->random(rand(1, 7))->pluck('id')->toArray()
            );
        });
        
        // Another Way 

        // foreach($doctors as $doctor){
        //     $appointment_id = Appointment::all()->random()->id;
        //     $doctor->doctors_appointments_pivot()->attach($appointment_id);
        // }

    }
}