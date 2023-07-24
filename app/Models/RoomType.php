<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RoomType extends Model
{
    use HasFactory;
    protected $fillable =['room_name','room_price','default_room_price','rooming','room_description','room_size','facilities'];
    
    protected $with = ['photos'];

    public function photos(){
        return $this->hasMany(Photo::class);
    }
    
}
