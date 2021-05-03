<?php

namespace Database\Seeders;

use App\Data\Models\Author;
use App\Data\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Author::factory(10)->create();
        Book::factory(10)->create();
    }
}
