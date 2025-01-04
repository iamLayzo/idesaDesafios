<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_book()
    {
        $author = Author::factory()->create();

        $book = Book::factory()->create([
            'title' => 'Pride and Prejudice',
            'isbn' => '1234567890',
            'published_date' => '1813-01-28',
            'author_id' => $author->id,
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'Pride and Prejudice',
            'isbn' => '1234567890',
            'published_date' => '1813-01-28',
            'author_id' => $author->id,
        ]);
    }

    /** @test */
    public function it_can_update_a_book()
    {
        $book = Book::factory()->create();
        $book->update(['title' => 'Updated Title']);

        $this->assertDatabaseHas('books', ['title' => 'Updated Title']);
    }

    /** @test */
    public function it_can_delete_a_book()
    {
        $book = Book::factory()->create();
        $book->delete();

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
