<?php

namespace Tests\Unit\Domains\Author\Jobs;

use App\Data\Models\Author;
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
        $author = Author::factory()->create();

        $first_name = $author->first_name.'_update';
        $last_name = $author->last_name.'_update';

        $job = new UpdateAuthorJob($author, $first_name, $last_name);
        $job->handle();

        self::assertEquals($first_name,$author->first_name);
        self::assertEquals($last_name,$author->last_name);
    }
}