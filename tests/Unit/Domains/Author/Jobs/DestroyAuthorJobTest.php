<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Author\Jobs;

use App\Data\Models\Author;
use App\Data\Repository\Author\WriteAuthor;
use Tests\TestCase;
use App\Domains\Author\Jobs\DestroyAuthorJob;

class DestroyAuthorJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_destroy_author_job(): void
    {
        $job = new DestroyAuthorJob(1);

        $stub = $this->createMock(WriteAuthor::class);

        $stub->method('destroy')
             ->willReturn(true);

        $result = $job->handle($stub);

        self::assertTrue($result);
    }
}
