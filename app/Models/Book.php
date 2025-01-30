<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    //
    protected $fillable =
    [
        'title',
        'author',
        'isbn',
        'publisher',
        'published_year',
        'genre',
        'total_copies',
        'available_copies',
        'cover_image',
        'description'
    ];

    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }
}
