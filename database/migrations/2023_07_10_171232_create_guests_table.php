<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('guest_title');
            $table->string('guest_name');
            $table->date('DOB');
            $table->string('gender');
            $table->string('photo');
            $table->string('phone_no');
            $table->string('email')->unique();
            $table->string('nrc');
            $table->string('address');
            $table->string('passport_no');
            $table->string('post_code');
            $table->string('city');
            $table->string('country');
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
