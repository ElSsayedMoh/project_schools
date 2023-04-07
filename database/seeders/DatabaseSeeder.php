<?php

namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Database\Seeders\TypeBloodSeeder;
use Database\Seeders\NationalitiesSeeder;
use Database\Seeders\ReligionSeeder;

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
    }
}
