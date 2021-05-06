<?php

namespace Tests\Feature;

use App\Data\Models\Author;
use App\Data\Models\Book;
use App\Data\Models\User;
use Tests\TestCase;

class UpdateBookFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_update_book_feature(): void
    {
        $this->withoutExceptionHandling();
            $authors = Author::factory()->count(2)->create();

            $book = Book::factory()
                ->hasAttached($authors)
                ->create();

            $user = User::factory()->create();

            $this->actingAs($user)->putJson(route('books.update', $book->id), [
                'title' => $book->title . '_update',
                'description' => $book->description . '_update',
            ])
                ->assertSuccessful()
                ->assertJsonPath('data.title', $book->title . '_update')
                ->assertJsonPath('data.description', $book->description . '_update')
                ->assertJsonCount(2,'data.authors')
                ->assertJsonPath('data.authors.*.id',$authors->pluck('id')->toArray())
                ->assertJsonPath('data.authors.*.first_name',$authors->pluck('first_name')->toArray())
                ->assertJsonPath('data.authors.*.last_name',$authors->pluck('last_name')->toArray())
            ;
    }
}
