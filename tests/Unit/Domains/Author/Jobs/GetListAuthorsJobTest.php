<?php

namespace Tests\Unit\Domains\Author\Jobs;

use App\Data\Models\Author;
use App\Domains\Author\Requests\ListAuthors;
use Tests\TestCase;
use App\Domains\Author\Jobs\GetListAuthorsJob;

class GetListAuthorsJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_get_list_authors_job(): void
    {
        Author::factory()->count(10)->create();

        $mockRequest = ListAuthors::create(route('login'), 'GET', [
            'limit' => 5,
            'order' => 'first_name',
            'orderBy' => 'desc',
        ]);

        $job = new GetListAuthorsJob($mockRequest);

        $result = $job->handle();

        self::assertEquals(5, $result->collect()->count());
        self::assertEquals(Author::count(), $result->total());

    }
}
