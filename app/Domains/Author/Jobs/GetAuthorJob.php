<?php

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
use Lucid\Units\Job;

class GetAuthorJob extends Job
{
    /**
     * @var Author
     */
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
     * @return Author
     */
    public function handle(): Author
    {
        $this->author->load('books');

        return $this->author;
    }
}
