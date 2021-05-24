<?php

namespace Database\Seeders;

use App\Data\Models\Author;
use App\Data\Models\Book;
use App\Data\Models\User;
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
        Book::factory()->count(10)->hasAttached(Author::factory()->count(2)->create())->create();
        Book::factory()->count(2)->create();
        Author::factory()->count(2)->create();
        User::factory()->count(2)->create();
    }
}
