<?php

namespace App\Domains\Book\Jobs;

use App\Data\Models\Book;
use Lucid\Units\Job;

class GetBookByIdJob extends Job
{
    private int $book_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $book_id)
    {
        $this->book_id = $book_id;
    }

    /**
     * Execute the job.
     *
     * @return mixed
     */
    public function handle(Book $book): mixed
    {
        return $book->where('id', $this->book_id)->with('authors')->first();
    }
}
