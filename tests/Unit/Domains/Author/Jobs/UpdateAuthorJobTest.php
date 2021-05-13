<?php

namespace Tests\Unit\Domains\Author\Jobs;

use App\Data\Models\Author;
use App\Data\Repository\Author\AuthorRepository;
use App\Domains\Author\Requests\ListAuthors;
use Tests\TestCase;
use App\Domains\Author\Jobs\UpdateAuthorJob;

class UpdateAuthorJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_update_author_job(): void
    {
        $author = Author::factory()->make();

        $job = new UpdateAuthorJob(1, $author->first_name, $author->last_name);

        $stub = $this->createMock(AuthorRepository::class);

        $stub->method('update')
             ->willReturn(true);

        $updateAuthor = Author::factory()->make();

        $stub->method('find')
             ->willReturn($updateAuthor);

        $author = $job->handle($stub,$stub);

        self::assertEquals($updateAuthor->first_name,$author->first_name);
        self::assertEquals($updateAuthor->last_name,$author->last_name);
    }
}
