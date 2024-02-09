<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    // fillable attributes
    protected $fillable = ['id', 'title', 'slug', 'content', 'category_id'];



    /**
     * Un post il a une seule catégorie
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }





    /**
     * Un post est peut avoir plusieur tags
     *
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
