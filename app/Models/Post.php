<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id'];

    public function user() {
        //User::class - user model, 'user_id' column in posts table
        return $this->belongsTo(User::class, 'user_id');
    }
}