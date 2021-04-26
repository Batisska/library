<?php

namespace Tests\Unit\Domains\Book\Jobs;

use App\Data\Models\Book;
use Tests\TestCase;
use App\Domains\Book\Jobs\DestroyBookJob;

class DestroyBookJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_destroy_book_job(): void
    {
        $book = Book::factory()->create();

        $job = new DestroyBookJob($book);
        $job->handle();

        $this->assertSoftDeleted((new Book())->getTable(),[
            'id' => $book->id
        ]);
    }
}
