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
        'language',
        'published_year',
        'genre',
        'number_of_pages',
        'cover_image',
        'synopsis'
    ];

    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function bookCategories(): HasMany
    {
        return $this->hasMany(BookCategory::class);
    }
}
