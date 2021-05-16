<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Author\Jobs;

use App\Data\Models\Author;
use App\Data\Repository\Author\WriteAuthor;
use Tests\TestCase;
use App\Domains\Author\Jobs\SaveAuthorJob;

class SaveAuthorJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_save_author_job(): void
    {
        $author = Author::factory()->make();

        $job = new SaveAuthorJob($author->first_name, $author->last_name);

        $stub = $this->createMock(WriteAuthor::class);

        $stub->method('create')
             ->willReturn($author);

        $stub->method('attach')
             ->willReturn($author);

        $result = $job->handle($stub);

        self::assertEquals($author->first_name, $result['first_name']);
        self::assertEquals($author->last_name, $result['last_name']);
    }
}
