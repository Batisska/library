<?php

namespace Tests\Unit\Domains\Author\Jobs;

use App\Data\Models\Author;
use Tests\TestCase;
use App\Domains\Author\Jobs\GetAuthorJob;

class GetAuthorJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_get_author_job(): void
    {
        $author = Author::factory()->create();

        $job = new GetAuthorJob($author);
        $result = $job->handle();

        self::assertEquals($result->id,$author->id);

    }
}
