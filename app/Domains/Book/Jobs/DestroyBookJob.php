<?php

namespace App\Domains\Book\Jobs;

use App\Data\Models\Book;
use Lucid\Units\Job;

class DestroyBookJob extends Job
{
    private Book $book;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Execute the job.
     *
     * @return bool|null
     */
    public function handle(): ?bool
    {
        return $this->book->delete();
    }
}
