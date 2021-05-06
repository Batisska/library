<?php

namespace App\Domains\Book\Jobs;

use App\Data\Models\Book;
use Lucid\Units\Job;

class SaveBookJob extends Job
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
     * @var array
     */
    private array $author_id;

    /**
     * Create a new job instance.
     *
     * @param string $title
     * @param string $description
     * @param array $author_id
     */
    public function __construct(string $title, string $description, array $author_id)
    {
        $this->title = $title;
        $this->description = $description;
        $this->author_id = $author_id;
    }

    /**
     * Execute the job.
     *
     * @param Book $book
     * @return Book
     */
    public function handle(Book $book): Book
    {
        $book = $book->create([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        $book->authors()->attach($this->author_id);

        $book->load('authors');

        return $book;
    }
}
