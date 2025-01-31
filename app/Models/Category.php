<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    //
    protected $fillable = 
    [
        'name'
    ];

    public function bookCategories(): HasMany
    {
        return $this->hasMany(BookCategory::class);
    }
}
