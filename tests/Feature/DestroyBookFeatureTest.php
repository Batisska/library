<?php

namespace Tests\Feature;

use App\Data\Models\Book;
use App\Data\Models\User;
use Tests\TestCase;

class DestroyBookFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_destroy_book_feature(): void
    {
        $book = Book::factory()->create();

        $user = User::factory()->create();

        $this->actingAs($user)->deleteJson(route('books.destroy',$book->id))
            ->assertSuccessful();

        $this->assertSoftDeleted((new Book)->getTable(),[
            'id' => $book->id
        ]);
    }
}
