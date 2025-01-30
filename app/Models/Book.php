<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'available_copies'
    ];
}
