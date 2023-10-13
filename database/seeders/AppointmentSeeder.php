<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('appointments')->delete();
        $appointments = [
            ['name'=>'السبت'],
            ['name'=>'الأحد'],
            ['name'=>'الإثنين'],
            ['name'=>'الثلاثاء'],
            ['name'=>'الأربعاء'],
            ['name'=>'الخميس'],
            ['name'=>'الجمعة'],
        ];
        // for (en) replace content with
        /*
            ['name'=>'Saturday'],
            ['name'=>'Sunday'],
            ['name'=>'Monday'],
            ['name'=>'Tuesday'],
            ['name'=>'Wdnesday'],
            ['name'=>'Thursday'],
            ['name'=>'Friday'],
        */

        foreach($appointments as $appointment){
            Appointment::create($appointment);
        }
    }
}
