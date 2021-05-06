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
     * @var int
     */
    private int $book_id;

    /**
     * Create a new job instance.
     *
     * @return void
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
     * @param Book $book
     * @return mixed
     */
    public function handle(Book $book): mixed
    {
        $book->where('id',$this->book_id)->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        return $book->where('id',$this->book_id)->with('authors')->first();;
    }
}
