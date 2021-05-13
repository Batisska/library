<?php

namespace App\Domains\Book\Jobs;

use App\Data\Repository\ReadBook;
use App\Data\Repository\WriteBook;
use Lucid\Units\Job;

class UpdateBookJob extends Job
{
    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var int
     */
    private int $book_id;

    /**
     * Create a new job instance.
     *
     * @param int $book_id
     * @param string $title
     * @param string $description
     */
    public function __construct(int $book_id,string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
        $this->book_id = $book_id;
    }

    /**
     * Execute the job.
     *
     * @param WriteBook $book
     * @return mixed
     */
    public function handle(WriteBook $book): mixed
    {
        $book->update($this->book_id,[
            'title' => $this->title,
            'description' => $this->description,
        ]);

        return $book->find($this->book_id);
    }
}
