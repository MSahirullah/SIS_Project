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
        Schema::create('student_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('req_no', 50)->unique();
            $table->string('index_no', 50)->unique();
            $table->string('combination', 300)->nullable();
            $table->string('home_phone');
            $table->string('permanent_address', 1000)->nullable();
            $table->string('preferred_address', 1000)->nullable();
            $table->string('temporary_address', 1000)->nullable();
            $table->date('req_date');
            $table->string('al_index', 50);
            $table->string('applied_year', 10);
            $table->string('district', 100);
            $table->integer('foreign_category')->default(0);
            $table->integer('transfers')->default(0);
            $table->integer('medium');
            $table->integer('z-score');
            $table->string('race')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('emg_contact_name', 500)->nullable();
            $table->string('emg_contact_relation')->nullable();
            $table->string('emg_contact_no')->nullable();
            $table->string('emg_contact_address', 1000)->nullable();
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
        Schema::dropIfExists('student_information');
    }
};
