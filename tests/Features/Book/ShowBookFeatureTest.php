<?php

namespace Tests\Features\Book;

use App\Data\Models\Author;
use App\Data\Models\Book;
use App\Data\Models\User;
use App\Data\Repository\Book\ReadBook;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class ShowBookFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_show_book_feature(): void
    {
        $book = Book::factory()->make();

        $authors = Author::factory()->count(2)->make();

        $book->setRelation('authors', $authors);

        $this->instance(ReadBook::class, Mockery::mock(ReadBook::class, function (MockInterface $mock) use ($book) {
            $mock->shouldReceive('find')->once()->andReturn($book);
        }));

        $user = User::factory()->make();

        $this->actingAs($user)
             ->getJson(route('books.show', 10))
             ->assertSuccessful()
             ->assertJsonPath('data.id', $book->id)
             ->assertJsonPath('data.title', $book->title)
             ->assertJsonPath('data.description', $book->description)
             ->assertJsonPath('data.authors.*.id', $authors->pluck('id')->toArray())
             ->assertJsonPath('data.authors.*.first_name', $authors->pluck('first_name')->toArray())
             ->assertJsonPath('data.authors.*.last_name', $authors->pluck('last_name')->toArray());
    }
}
