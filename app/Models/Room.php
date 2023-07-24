<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['room_no','room_type_id','hotel_id','room_occupancy'];

    protected $with = ['roomtypes','hotels'];

    public function roomtypes(){
        return $this->belongsTo(RoomType::class,'room_type_id');
    }

    public function hotels(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }
   
}
