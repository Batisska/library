<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Book\Jobs;

use App\Data\Models\Book;
use App\Data\Repository\Book\BookRepository;
use Tests\TestCase;
use App\Domains\Book\Jobs\DestroyBookJob;

class DestroyBookJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_destroy_book_job(): void
    {
        $job = new DestroyBookJob(1);

        $stub = $this->createMock(BookRepository::class);

        $stub->method('destroy')
            ->willReturn(true);

        $result = $job->handle($stub);

        self::assertTrue($result);
    }
}
