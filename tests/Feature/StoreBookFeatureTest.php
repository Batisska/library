<?php

namespace Tests\Feature;

use App\Data\Models\Author;
use App\Data\Models\Book;
use App\Data\Models\User;
use Tests\TestCase;
use App\Features\StoreBookFeature;

class StoreBookFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_store_book_feature(): void
    {
        $this->withoutExceptionHandling();
        $book = Book::factory()->make();
        $authors = Author::factory()->count(2)->create();

        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('books.store'), [
            'title' => $book->title,
            'description' => $book->description,
            'author_id' => $authors->pluck('id'),
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.title', $book->title)
            ->assertJsonPath('data.description', $book->description)
            ->assertJsonCount(2,'data.authors')
            ->assertJsonPath('data.authors.*.id',$authors->pluck('id')->toArray())
            ->assertJsonPath('data.authors.*.first_name',$authors->pluck('first_name')->toArray())
            ->assertJsonPath('data.authors.*.last_name',$authors->pluck('last_name')->toArray())
        ;
    }
}
