<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = [
    'invoice_no',
    'booking_id',
    'guest_id',
    'room_charge',
    'room_service',
    'restaurant_charges',
    'bar_charges',
    'misc_charges',
    'late_checkout_charges',
    'payment_date',
    'payment_mode',
    'creditcard_no',
    'expire_date',
    'cheque_no'
    ];

    protected $with =['bookings','guests'];


    public function guests(){
        return $this->belongsTo(Guest::class,'guest_id');
    }

    public function bookings(){
        return $this->belongsTo(Booking::class,'booking_id');
    }
}
