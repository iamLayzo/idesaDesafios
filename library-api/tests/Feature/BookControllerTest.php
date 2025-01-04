<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Models\User;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_books()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        Book::factory()->count(3)->create();

        $response = $this->getJson('/api/books');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    /** @test */
    public function it_can_show_a_book()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $book = Book::factory()->create();

        $response = $this->getJson("/api/books/{$book->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => $book->title]);
    }

    /** @test */
    public function it_returns_404_for_non_existent_book()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->getJson('/api/books/999');

        $response->assertStatus(404)
                 ->assertJson(['error' => 'Book not found']);
    }

    /** @test */
    public function it_can_create_a_book()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $author = Author::factory()->create();
        $data = [
            'title' => 'New Book',
            'isbn' => '1234567890',
            'published_date' => '2020-01-01',
            'author_id' => $author->id,
        ];

        $response = $this->postJson('/api/books', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'New Book']);
    }

    /** @test */
    public function it_validates_book_creation()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->postJson('/api/books', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['title', 'isbn', 'published_date', 'author_id']);
    }
}
