<?php

namespace App\Domains\Book\Jobs;

use App\Data\Models\Book;
use App\Data\Repository\ReadBook;
use App\Data\Repository\WriteBook;
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
     * @param WriteBook $book
     * @return bool
     */
    public function handle(WriteBook $book): bool
    {
        return (bool)$book->destroy($this->book_id);
    }
}
