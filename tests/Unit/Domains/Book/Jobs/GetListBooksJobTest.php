<?php

namespace Tests\Unit\Domains\Book\Jobs;

use App\Data\Models\Book;
use App\Domains\Book\Requests\ListBooks;
use Tests\TestCase;
use App\Domains\Book\Jobs\GetListBooksJob;

class GetListBooksJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_get_list_books_job(): void
    {
        Book::factory()->count(10)->create();

        $mockRequest = ListBooks::create(route('login'), 'GET', [
            'limit' => 5,
            'order' => 'title',
            'orderBy' => 'desc',
        ]);

        $job = new GetListBooksJob($mockRequest);

        $result = $job->handle();

        self::assertEquals(5, $result->collect()->count());
        self::assertEquals(Book::count(), $result->total());
    }
}
