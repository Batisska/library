<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Book\Jobs;

use App\Data\Models\Author;
use App\Data\Models\Book;
use App\Data\Repository\Book\BookRepository;
use Tests\TestCase;
use App\Domains\Book\Jobs\GetBookByIdJob;

class GetBookByIdJobTest extends TestCase
{
    public function test_get_book_by_id_job(): void
    {
        $authors = Author::factory()->count(2)->make();

        $book = Book::factory()
            ->hasAttached($authors)
            ->make();

        $book->setRelation('authors', $authors);

        $job = new GetBookByIdJob(book_id:1);

        $stub = $this->createMock(BookRepository::class);

        $stub->method('find')
            ->willReturn($book);

        $result = $job->handle($stub);

        self::assertEquals($result->id, $book->id);
        self::assertEquals($result->authors->toArray(), $book->authors->toArray());
    }
}
