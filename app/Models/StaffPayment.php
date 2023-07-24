<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffPayment extends Model
{
    use HasFactory;
    protected $fillable = ['staff_id','amount','payment_date'];

    protected $with = ['staffs'];

    public function staffs(){
        return $this->belongsTo(Staff::class,'staff_id');
    }
}
