<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = \App\Models\Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'isbn' => $this->faker->isbn13,
            'published_date' => $this->faker->date,
            'author_id' => \App\Models\Author::factory(),
        ];
    }
}

