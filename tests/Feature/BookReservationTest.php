<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
use Throwable;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library(): void
    {
        $this->withExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Cool Book Title',
            'author' => 'Todd Twiggs',
        ]);

        $response->assertOk();
        self::assertCount(1, Book::all());
    }

    /** @test **/
    public function a_title_and_author_are_required()
    {
        $this->withExceptionHandling();

        $response = $this->post('/books', [
            'title' => '',
            'author' => '',
        ]);

        $response->assertSessionHasErrors();
    }

    /** @test **/
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Cool Title',
            'author' => 'Todd Twiggs',
        ]);

        $book = Book::first();

        $this->patch('/books/'.$book->id, [
            'title' => 'New Title',
            'author' => 'New Author'
        ]);

        self::assertEquals('New Title', Book::first()->title);
        self::assertEquals('New Author', Book::first()->author);
    }

}
