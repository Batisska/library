<?php

namespace App\Domains\Book\Jobs;

use App\Data\Models\Book;
use App\Data\Repository\BookRepositoryInterface;
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
     * @param BookRepositoryInterface $book
     * @return mixed
     */
    public function handle(BookRepositoryInterface $book): mixed
    {
        return $book->find($this->book_id);
    }
}
