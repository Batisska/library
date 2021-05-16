<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Author\Jobs;

use App\Data\Models\Author;
use App\Data\Repository\Author\ReadAuthor;
use App\Data\Repository\Book\BookRepository;
use App\Domains\Author\Requests\ListAuthors;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;
use App\Domains\Author\Jobs\GetListAuthorsJob;

class GetListAuthorsJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_get_list_authors_job(): void
    {
        $authors = Author::factory()->count(5)->make();

        $data = [
            'limit' => 5,
            'order' => 'first_name',
            'orderBy' => 'desc',
        ];

        $job = new GetListAuthorsJob($data['order'], $data['orderBy'], $data['limit']);

        $stub = $this->createMock(originalClassName: ReadAuthor::class);

        $paginator = new LengthAwarePaginator(items: $authors, total: 10, perPage: 5);

        $stub->method('paginate')->willReturn($paginator);

        $result = $job->handle($stub);

        self::assertCount(5, $result->items());
        self::assertEquals(10, $result->total());
    }
}
