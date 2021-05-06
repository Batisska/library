<?php

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
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
     *
     * @return void
     */
    public function __construct(int $author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * Execute the job.
     *
     * @param Author $author
     * @return bool|null
     */
    public function handle(Author $author): ?bool
    {
        return $author->where('id',$this->author_id)->delete();
    }
}
