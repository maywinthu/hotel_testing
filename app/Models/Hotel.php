<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    
    protected $fillable = ['hotel_code','hotel_name','address','post_code','city','country','num_rooms','phone_no','star_rating'];
}
