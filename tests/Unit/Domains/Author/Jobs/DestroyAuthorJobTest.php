<?php

namespace Tests\Unit\Domains\Author\Jobs;

use App\Data\Models\Author;
use Tests\TestCase;
use App\Domains\Author\Jobs\DestroyAuthorJob;

class DestroyAuthorJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_destroy_author_job(): void
    {
        $author = Author::factory()->create();

        $job = new DestroyAuthorJob($author);
        $job->handle();

        $this->assertSoftDeleted((new Author())->getTable(),[
            'id' => $author->id
        ]);
    }
}
