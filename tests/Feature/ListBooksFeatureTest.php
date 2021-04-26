<?php

namespace Tests\Feature;

use App\Data\Models\Book;
use App\Data\Models\User;
use Tests\TestCase;

class ListBooksFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_list_books_feature(): void
    {
        Book::factory()->count(10)->create();

        $user = User::factory()->create();

        $this->actingAs($user)->getJson(route('books.index',[
            'limit' => 5,
            'column' => 'title',
            'desc' => 'desc',
        ]))
            ->assertJsonCount(5,'data.data')
            ->assertSuccessful();
    }
}
