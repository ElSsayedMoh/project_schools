<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');
            $table->foreignId('fee_invoice_id')->nullable()->references('id')->on('fee_invoices')->onDelete('cascade');
            $table->foreignId('receipt_id')->nullable()->references('id')->on('receipt_students')->onDelete('cascade');
            $table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->decimal('Debit',8,2)->nullable();
            $table->decimal('credit',8,2)->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreignId('grade_id')->references('id')->on('grades')->onDelete('cascade')->nullable();
            $table->foreignId('classroom_id')->references('id')->on('class_rooms')->onDelete('cascade')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_accounts');
    }
}
