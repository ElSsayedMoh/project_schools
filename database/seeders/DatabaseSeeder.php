<?php

namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Database\Seeders\TypeBloodSeeder;
use Database\Seeders\NationalitiesSeeder;
use Database\Seeders\ReligionSeeder;
use Database\Seeders\GenderSeeder;
use Database\Seeders\SpecializationSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\GradeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(TypeBloodSeeder::class);
        $this->call(NationalitiesSeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(SettingSeeder::class);
    }
}
