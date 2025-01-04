<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear 10 autores y cada uno con 5 libros
        Author::factory(10)->hasBooks(5)->create();
    }
}
