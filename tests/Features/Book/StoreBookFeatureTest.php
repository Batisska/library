<?php

namespace Tests\Features\Book;

use App\Data\Models\Author;
use App\Data\Models\Book;
use App\Data\Models\User;
use App\Data\Repository\Book\WriteBook;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class StoreBookFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_store_book_feature(): void
    {
        $book = Book::factory()->make();

        $authors = Author::factory()->count(2)->make();

        $book->setRelation('authors', $authors);

        $this->instance(WriteBook::class, Mockery::mock(WriteBook::class, function (MockInterface $mock) use ($book) {
            $mock->shouldReceive('create')->once()->andReturn($book);
            $mock->shouldReceive('attach')->once()->andReturn($book);
        }));

        $user = User::factory()->make();

        $this->actingAs($user)->postJson(route('books.store'), [
            'title' => $book->title,
            'description' => $book->description,
            'author_id' => $authors->pluck('id'),
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.title', $book->title)
            ->assertJsonPath('data.description', $book->description)
            ->assertJsonCount(2, 'data.authors')
            ->assertJsonPath('data.authors.*.first_name', $authors->pluck('first_name')->toArray())
            ->assertJsonPath('data.authors.*.last_name',$authors->pluck('last_name')->toArray());

    }
}
