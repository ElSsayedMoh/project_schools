<?php

namespace Database\Seeders;

use App\Models\Genders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();
            $Gender = [
                ['ar' => 'ذكر'  ,  'en' =>  'male' ],
                ['ar' => 'أنثي' ,  'en' => 'female'],
            ];

        foreach($Gender as $gender){
            Genders::create(['name' => $gender]);
        }
    }
}
