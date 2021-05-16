<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Book\Jobs;

use App\Data\Models\Book;
use App\Data\Repository\Book\BookRepository;
use App\Domains\Book\Jobs\GetListBooksJob;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class GetListBooksJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_get_list_books_job(): void
    {
        $books = Book::factory()->count(5)->make();

        $data = [
            'limit' => 5,
            'order' => 'first_name',
            'orderBy' => 'desc',
        ];

        $job = new GetListBooksJob(column: $data['order'], desc: $data['orderBy'], limit: $data['limit']);

        $stub = $this->createMock(originalClassName: BookRepository::class);

        $paginator = new LengthAwarePaginator(items: $books, total: 10, perPage: 5);

        $stub->method('paginate')->willReturn($paginator);

        $result = $job->handle(book: $stub);

        self::assertCount(5, $result->items());
        self::assertEquals(10, $result->total());
    }
}
