<?php

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
use App\Data\Repository\Author\WriteAuthor;
use Lucid\Units\Job;
use Tests\Feature\DestroyAuthorFeatureTest;
use Tests\Unit\Domains\Author\Jobs\DestroyAuthorJobTest;

/**
 * Class DestroyAuthorJob
 * @package App\Domains\Author\Jobs
 * @see DestroyAuthorFeatureTest
 * @see DestroyAuthorJobTest
 */
class DestroyAuthorJob extends Job
{
    /**
     * @var int
     */
    private int $author_id;

    /**
     * Create a new job instance.
     * @param int $author_id
     * @return void
     */
    public function __construct(int $author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * Execute the job.
     *
     * @param WriteAuthor $author
     * @return bool|null
     */
    public function handle(WriteAuthor $author): ?bool
    {
        return $author->destroy($this->author_id);
    }
}
