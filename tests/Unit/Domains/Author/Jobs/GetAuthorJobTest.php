<?php

namespace Tests\Unit\Domains\Author\Jobs;

use App\Data\Models\Author;
use App\Data\Repository\Author\ReadAuthor;
use Tests\TestCase;
use App\Domains\Author\Jobs\GetAuthorJob;

class GetAuthorJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_get_author_job(): void
    {
        $author = Author::factory()->make();

        $job = new GetAuthorJob(1);

        $stub = $this->createMock(ReadAuthor::class);

        $stub->method('find')
             ->willReturn($author);

        $result = $job->handle($stub);

        self::assertEquals($result->id,$author->id);

    }
}
