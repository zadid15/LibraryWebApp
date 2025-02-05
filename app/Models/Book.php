<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Book extends Model
{
    //
    protected $fillable =
    [
        'title',
        'author',
        'publisher',
        'isbn',
        'language',
        'published_year',
        'genre',
        'number_of_pages',
        'cover_image',
        'synopsis',
        'slug'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

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
