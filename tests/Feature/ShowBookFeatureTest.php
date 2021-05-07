<?php

namespace Tests\Feature;

use App\Data\Models\Author;
use App\Data\Models\Book;
use App\Data\Models\User;
use Tests\TestCase;

class ShowBookFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_show_book_feature(): void
    {
            $authors = Author::factory()->count(3)->create();

            $book = Book::factory()
                ->hasAttached($authors)
                ->create();

            $user = User::factory()->create();

            $this->actingAs($user)->getJson(route('books.show', $book->id))
                ->assertSuccessful()
                ->assertJsonPath('data.id', $book->id)
                ->assertJsonPath('data.authors.*.id',$authors->pluck('id')->toArray())
                ->assertJsonPath('data.authors.*.first_name',$authors->pluck('first_name')->toArray())
                ->assertJsonPath('data.authors.*.last_name',$authors->pluck('last_name')->toArray())
            ;
    }
}
