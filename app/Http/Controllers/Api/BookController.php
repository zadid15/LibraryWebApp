<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        //
        $books = Book::all();
        return BookResource::collection($books);
    }

    public function show(string $slug)
    {
        //
        $book = Book::where('slug', $slug)->firstOrFail();
        return new BookResource($book);
    }
}