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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_no');
            $table->foreignId('booking_id');
            $table->foreignId('guest_id');
            $table->string('room_charge');
            $table->bigInteger('room_service');
            $table->bigInteger('restaurant_charges');
            $table->bigInteger('bar_charges');
            $table->bigInteger('misc_charges');
            $table->bigInteger('late_checkout_charges');
            $table->date('payment_date');
            $table->string('payment_mode');
            $table->bigInteger('creditcard_no');
            $table->date('expire_date');
            $table->bigInteger('cheque_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
