<?php

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
use Lucid\Units\Job;

class GetAuthorJob extends Job
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
     * @return mixed
     */
    public function handle(Author $author): mixed
    {
        return $author->where('id',$this->author_id)->with('books')->first();
    }
}
