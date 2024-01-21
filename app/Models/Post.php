<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // fillable attributes
    protected $fillable = ['id', 'title', 'slug', 'content', 'category_id'];



    /**
     * Un post appartien à une seule catégorie
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
