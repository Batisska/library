<?php

namespace Tests\Feature;

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
        $book = Book::factory()->make();

        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('books.store'), [
            'title' => $book->title,
            'description' => $book->description,
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.title', $book->title)
            ->assertJsonPath('data.description', $book->description)
        ;
    }
}
