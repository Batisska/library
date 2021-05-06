<?php

namespace Tests\Unit\Domains\Book\Jobs;

use App\Data\Models\Author;
use App\Data\Models\Book;
use Tests\TestCase;
use App\Domains\Book\Jobs\GetBookByIdJob;

class GetBookByIdJobTest extends TestCase
{
    public function test_get_book_by_id_job()
    {
        $authors = Author::factory()->count(2)->create();
        $book = Book::factory()
            ->hasAttached($authors)
            ->create();

        $job = new GetBookByIdJob($book->id);

        $result = $job->handle(new Book);

        self::assertEquals($result->id,$book->id);
        self::assertEquals($result->authors->toArray(),$book->authors->toArray());
    }
}
