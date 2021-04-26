<?php

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
use Lucid\Units\Job;

class DestroyAuthorJob extends Job
{
    private Author $author;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    /**
     * Execute the job.
     *
     * @return bool|null
     */
    public function handle(): ?bool
    {
        return $this->author->delete();
    }
}
