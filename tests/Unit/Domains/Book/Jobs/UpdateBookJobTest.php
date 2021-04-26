<?php

namespace Tests\Unit\Domains\Book\Jobs;

use App\Data\Models\Book;
use App\Domains\Book\Requests\ListBooks;
use Tests\TestCase;
use App\Domains\Book\Jobs\UpdateBookJob;

class UpdateBookJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_update_book_job(): void
    {
        $book = Book::factory()->create();

        $title = $book->title.'_update';
        $description = $book->description.'_update';

        $job = new UpdateBookJob($book, $title, $description);
        $job->handle();

        self::assertEquals($title,$book->title);
        self::assertEquals($description,$book->description);
    }
}
