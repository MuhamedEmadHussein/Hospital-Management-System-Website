<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Patient::create([
            'name' => 'محمد عماد',
            'email' => 'emad@gmail.com',
            'password' => Hash::make('123456'),
            'Date_Birth' => '2000-12-18',
            'Gender' => '1',
            'Phone' => '0101369873',
            'Blood_Group' => 'A+',
            'Address' => 'القاهرة - مصر'
        ]);
    }
}
