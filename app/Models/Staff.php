<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $fillable = ['staffrole_id','name','photo','bio','DOB','gender','phone','email','password','salary_type','salary_amount','first_name','last_name'];

    
    protected $with = ['staffroles'];

    public function staffroles(){
        return $this->belongsTo(StaffRole::class,'staffrole_id');
    }
}
