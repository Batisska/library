<?php

declare(strict_types=1);

namespace Tests\Features\Author;

use App\Data\Models\Author;
use App\Data\Models\Book;
use App\Data\Models\User;
use App\Data\Repository\Author\ReadAuthor;
use App\Data\Repository\Book\ReadBook;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class ShowAuthorFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_show_author_feature(): void
    {
        $books = Book::factory()->count(5)->make();

        $author = Author::factory()
            ->hasAttached($books)
            ->make();

        $author->setRelation('books', $books);

        $user = User::factory()->make();

        $this->instance(ReadAuthor::class, Mockery::mock(ReadAuthor::class, function (MockInterface $mock) use ($author): void {
            $mock->shouldReceive('find')->once()->andReturn($author);
        }));


        $this->actingAs($user)->getJson(route('authors.show', 1))
            ->assertSuccessful()
            ->assertJsonPath('data.id', $author->id)
            ->assertJsonPath('data.books.*.id', $books->pluck('id')->toArray())
            ->assertJsonPath('data.books.*.title', $books->pluck('title')->toArray())
            ->assertJsonPath('data.books.*.description', $books->pluck('description')->toArray())
        ;
    }
}
