<?php

namespace Tests\Unit;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_author()
    {
        $author = Author::factory()->create([
            'name' => 'Jane Austen',
            'birthdate' => '1775-12-16',
            'nationality' => 'British',
        ]);

        $this->assertDatabaseHas('authors', [
            'name' => 'Jane Austen',
            'birthdate' => '1775-12-16',
            'nationality' => 'British',
        ]);
    }

    /** @test */
    public function it_can_update_an_author()
    {
        $author = Author::factory()->create();
        $author->update(['name' => 'Updated Name']);

        $this->assertDatabaseHas('authors', ['name' => 'Updated Name']);
    }

    /** @test */
    public function it_can_delete_an_author()
    {
        $author = Author::factory()->create();
        $author->delete();

        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }
}
