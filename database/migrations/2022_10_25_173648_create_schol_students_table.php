<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schol_students', function (Blueprint $table) {
            $table->id();

            $table->foreignId('scholarship_id')->constrained('scholarships')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            //$table->foreign('scholarship_id')->references('id')->on('scholarships')->onDelete('cascade');
            //$table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('amount', 10);
            $table->date('verified_date')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('schol_students');
    }
};
