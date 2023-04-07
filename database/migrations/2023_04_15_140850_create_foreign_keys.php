<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_rooms', function (Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('Grades')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('Grades')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });

        Schema::table('sections', function (Blueprint $table) {                       //////
            $table->foreign('class_id')->references('id')->on('class_rooms')     
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });

        Schema::table('parents', function (Blueprint $table) {
            // father
            $table->foreign('nationality_father_id')->references('id')->on('nationalities');
            $table->foreign('blood_father_id')->references('id')->on('type_bloods');
            $table->foreign('religion_father_id')->references('id')->on('religions');
            // mother
            $table->foreign('nationality_mother_id')->references('id')->on('nationalities');
            $table->foreign('blood_mother_id')->references('id')->on('type_bloods');
            $table->foreign('religion_mother_id')->references('id')->on('religions');

        });

        Schema::table('parent_attachments', function (Blueprint $table) {                       //////
            $table->foreign('parent_id')->references('id')->on('parents');
        });
    }

    public function down()
    {
        Schema::table('class_rooms', function(Blueprint $table){
            $table->dropForeign('class_rooms_grade_id_foreign');
        });

        Schema::table('sections', function(Blueprint $table){
            $table->dropForeign('sections_grade_id_foreign');
        });

        Schema::table('sections', function(Blueprint $table){
            $table->dropForeign('sections_class_id_foreign');
        });
    }
}
