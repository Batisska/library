<?php

namespace Tests\Features;

use App\Data\Models\Author;
use App\Data\Models\Book;
use App\Data\Models\User;
use App\Data\Repository\WriteBook;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateBookFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_update_book_feature(): void
    {
        $authors = Author::factory()->count(2)->make();

        $book = Book::factory()->hasAttached($authors)->make();

        $book->setRelation('authors', $authors);

        $this->instance(WriteBook::class, Mockery::mock(WriteBook::class, function (MockInterface $mock) use ($book) {
            $mock->shouldReceive('update')->once()->andReturn(true);
            $mock->shouldReceive('find')->once()->andReturn($book);
        }));

        $user = User::factory()->make();

        $this->actingAs($user)
             ->putJson(route('books.update', 1), [
                 'title' => $book->title,
                 'description' => $book->description,
             ])
             ->assertSuccessful()
             ->assertJsonPath('data.title', $book->title)
             ->assertJsonPath('data.description', $book->description)
             ->assertJsonCount(2, 'data.authors')
             ->assertJsonPath('data.authors.*.id', $authors->pluck('id')->toArray())
             ->assertJsonPath('data.authors.*.first_name', $authors->pluck('first_name')->toArray())
             ->assertJsonPath('data.authors.*.last_name', $authors->pluck('last_name')->toArray());
    }
}
