<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Author;
use App\Models\User;

class AuthorControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_authors()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        Author::factory()->count(5)->create();

        $response = $this->getJson('/api/v1/authors');

        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data');
    }

    /** @test */
    public function it_can_show_an_author()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $author = Author::factory()->create();

        $response = $this->getJson("/api/v1/authors/{$author->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $author->name]);
    }

    /** @test */
    public function it_returns_404_for_non_existent_author()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->getJson('/api/v1/authors/999');

        $response->assertStatus(404)
                 ->assertJson(['error' => 'Author not found']);
    }

    /** @test */
    public function it_can_create_an_author()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $data = [
            'name' => 'New Author',
            'birthdate' => '1980-01-01',
            'nationality' => 'American',
        ];

        $response = $this->postJson('/api/v1/authors', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'New Author']);
    }

    /** @test */
    public function it_validates_author_creation()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->postJson('/api/v1/authors', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'birthdate', 'nationality']);
    }
}
