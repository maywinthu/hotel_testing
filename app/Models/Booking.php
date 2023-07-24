<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['guest_id','room_id','checkin_date','checkout_date','num_adults','num_children','special_request'];
    
    protected $with = ['rooms','guests'];

    public function rooms(){
        return $this->belongsTo(Room::class,'room_id');
    }

    public function guests(){
        return $this->belongsTo(Hotel::class,'guest_id');
    }
}
