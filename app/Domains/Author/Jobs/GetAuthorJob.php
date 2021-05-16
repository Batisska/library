<?php

declare(strict_types=1);

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
use App\Data\Repository\Author\ReadAuthor;
use Lucid\Units\Job;

class GetAuthorJob extends Job
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
     * @param ReadAuthor $author
     * @return mixed
     */
    public function handle(ReadAuthor $author): mixed
    {
        return $author->find($this->author_id);
    }
}
