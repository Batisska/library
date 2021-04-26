<?php

namespace Tests\Feature;

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
        {
            $this->withoutExceptionHandling();
            $book = Book::factory()->create();

            $user = User::factory()->create();

            $this->actingAs($user)->putJson(route('books.update', $book->id), [
                'title' => $book->title . '_update',
                'description' => $book->description . '_update',
            ])->assertSuccessful()->assertJsonPath('data.title', $book->title . '_update')->assertJsonPath('data.description', $book->description . '_update');
        }
    }
}
