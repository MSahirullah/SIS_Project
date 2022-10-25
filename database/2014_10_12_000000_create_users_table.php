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
            $table->string('title');
            $table->string('name_with_initial', 1000);
            $table->string('first_name', 500);
            $table->string('last_name', 500);
            $table->string('full_name', 2000);
            $table->string('gender');
            $table->string('nic');
            $table->string('user_type');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('address');
            $table->string('hometown');
            $table->string('contact_no');
            $table->string('email')->unique();
            
            
            
            

            $table->rememberToken();
            $table->timestamps();
        });
    }

    // $table->string('name');
    // $table->string('email')->unique();
    // $table->timestamp('email_verified_at')->nullable();
    // $table->string('password');

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
