<?php

namespace Tests\Unit\Domains\Book\Jobs;

use App\Data\Models\Book;
use Tests\TestCase;
use App\Domains\Book\Jobs\SaveBookJob;

class SaveBookJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_save_book_job(): void
    {
        $book = Book::factory()->make();

        $job = new SaveBookJob($book->title, $book->description);

        $job->handle();

        $this->assertDatabaseHas((new Book())->getTable(),[
            'title' => $book->title,
            'description' => $book->description,
        ]);
    }
}
