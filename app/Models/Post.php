<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    // fillable attributes
    protected $fillable = ['id', 'title', 'slug', 'content'];
}
