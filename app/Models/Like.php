<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Like extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','post_id'];

    // protected $with = ['posts'];

    // public function posts(){
    //     return $this->belongsTo(Post::class);
    // }
}
