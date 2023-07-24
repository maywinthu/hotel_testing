<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','testi_cont'];

    protected $with = ['users'];

    public function users(){
        return $this->belongsTo(User::class);
    }


}
