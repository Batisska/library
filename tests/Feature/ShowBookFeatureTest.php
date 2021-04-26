<?php

namespace Tests\Feature;

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
        {
            $book = Book::factory()->create();

            $user = User::factory()->create();

            $this->actingAs($user)->getJson(route('books.show', $book->id))
                ->assertSuccessful()
                ->assertJsonPath('data.id', $book->id);
        }
    }
}
