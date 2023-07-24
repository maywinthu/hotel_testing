<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $fillable = ['guest_title','guest_name','DOB','gender','photo','phone_no','email','nrc','address','passport_no','post_code','city','country','password','first_name','last_name'];

    protected $with = ['bookings'];

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
