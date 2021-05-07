<?php

namespace App\Domains\Book\Jobs;

use App\Data\Models\Book;
use Lucid\Units\Job;

class DestroyBookJob extends Job
{
    /**
     * @var int
     */
    private int $book_id;

    /**
     * DestroyBookJob constructor.
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
     * @return bool
     */
    public function handle(Book $book): bool
    {
        return $book->where('id',$this->book_id)->delete();
    }
}
