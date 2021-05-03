<?php

namespace App\Domains\Book\Jobs;

use App\Data\Models\Book;
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
     * @var Book
     */
    private Book $book;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Book $book,string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
        $this->book = $book;
    }

    /**
     * Execute the job.
     *
     * @return Book
     */
    public function handle(): Book
    {
        $this->book->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        $this->book->load('authors');

        return $this->book;
    }
}
