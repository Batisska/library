<?php

namespace App\Domains\Book\Jobs;

use App\Data\Models\Book;
use Lucid\Units\Job;

class GetBookByIdJob extends Job
{
    /**
     * @var int
     */
    private int $book_id;

    /**
     * Create a new job instance.
     *
     * @param int $book_id
     */
    public function __construct(int $book_id)
    {
        $this->book_id = $book_id;
    }

    /**
     * Execute the job.
     *
     * @param Book $book
     * @return mixed
     */
    public function handle(Book $book): mixed
    {
        return $book->where('id', $this->book_id)->with('authors')->first();
    }
}
