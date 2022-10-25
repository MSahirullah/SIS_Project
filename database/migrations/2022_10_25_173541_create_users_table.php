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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('departments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semesters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('year_id')->constrained('years')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->string('name_with_initial', 1000)->nullable();
            $table->string('first_name', 1000);
            $table->string('last_name', 1000);
            $table->string('full_name', 1000)->nullable();
            $table->string('gender');
            $table->string('nic');
            $table->string('user_type');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('address', 1000);
            $table->string('hometown');
            $table->string('contact_no');
            $table->string('email')->unique();
            $table->string('profile_pic', 500)->nullable();
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
        Schema::dropIfExists('users');
    }
};
