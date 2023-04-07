<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {

            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            // fathers information
            $table->string('name_father');
            $table->string('national_id_father');
            $table->string('passport_id_father');
            $table->string('phone_father');
            $table->string('job_father');
            $table->string('address_father');
            $table->bigInteger('nationality_father_id')->unsigned();
            $table->bigInteger('blood_father_id')->unsigned();
            $table->bigInteger('religion_father_id')->unsigned();

            // mother information
            $table->string('name_mother');
            $table->string('national_id_mother');
            $table->string('passport_id_mother');
            $table->string('phone_mother');
            $table->string('job_mother');
            $table->string('address_mother');
            $table->bigInteger('nationality_mother_id')->unsigned();
            $table->bigInteger('blood_mother_id')->unsigned();
            $table->bigInteger('religion_mother_id')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parents');
    }
}
