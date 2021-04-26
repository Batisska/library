<?php

namespace Tests\Unit\Domains\Author\Jobs;

use App\Data\Models\Author;
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

        $job = new SaveAuthorJob($author->toArray());

        $job->handle();

        $this->assertDatabaseHas((new Author())->getTable(),[
            'first_name' => $author->first_name,
            'last_name' => $author->last_name,
        ]);
    }
}
