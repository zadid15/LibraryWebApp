<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'publisher' => $this->publisher,
            'isbn' => $this->isbn,
            'language' => $this->language,
            'published_year' => $this->published_year,
            'genre' => $this->genre,
            'number_of_pages' => $this->number_of_pages,
            'cover_image' => $this->cover_image,
            'synopsis' => $this->synopsis
        ];
    }
}
