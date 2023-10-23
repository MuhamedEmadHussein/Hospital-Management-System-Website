<?php

namespace Database\Seeders;

use App\Models\RayEmployee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RayEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        RayEmployee::create([
            'name' => 'محمد حامد',
            'email' => 'mo@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
