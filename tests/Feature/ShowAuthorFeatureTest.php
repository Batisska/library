<?php

namespace Tests\Feature;

use App\Data\Models\Author;
use App\Data\Models\Book;
use App\Data\Models\User;
use Tests\TestCase;

class ShowAuthorFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_show_author_feature(): void
    {
        $books = Book::factory()->count(5)->create();

        $author = Author::factory()
            ->hasAttached($books)
            ->create();

        $user = User::factory()->create();

        $this->actingAs($user)->getJson(route('authors.show', $author->id))
            ->assertSuccessful()
            ->assertJsonPath('data.id',$author->id)
            ->assertJsonPath('data.books.*.id',$books->pluck('id')->toArray())
            ->assertJsonPath('data.books.*.title',$books->pluck('title')->toArray())
            ->assertJsonPath('data.books.*.description',$books->pluck('description')->toArray())
        ;
    }
}
