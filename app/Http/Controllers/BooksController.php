<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store(): void
    {
        Book::create($this->validateRequest());
    }

    public function update(Book $book): void
    {
        $book->update($this->validateRequest());
    }

    private function validateRequest(): array
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required'
        ]);
    }
}
