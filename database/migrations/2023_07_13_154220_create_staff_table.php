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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->integer('staffrole_id');
            $table->string('name');
            $table->string('photo');
            $table->string('bio');
            $table->date('DOB');
            $table->string('gender');
            $table->string('phone');
            $table->string('email');
            $table->string('password');
            $table->string('salary_type');
            $table->string('salary_amount');
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
        Schema::dropIfExists('staff');
    }
};
