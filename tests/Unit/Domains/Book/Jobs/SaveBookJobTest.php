<?php

namespace Tests\Unit\Domains\Book\Jobs;

use App\Data\Models\Author;
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
        $author = Author::factory()->create();

        $job = new SaveBookJob($book->title, $book->description,$author->pluck('id')->toArray());

        $job->handle(new Book);

        $this->assertDatabaseHas((new Book())->getTable(),[
            'title' => $book->title,
            'description' => $book->description,
        ]);
    }
}
