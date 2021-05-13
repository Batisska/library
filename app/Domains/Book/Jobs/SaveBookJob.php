<?php

namespace App\Domains\Book\Jobs;

use App\Data\Models\Book;
use App\Data\Repository\BookRepository;
use App\Data\Repository\WriteBook;
use Illuminate\Database\Eloquent\Model;
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
     * @param WriteBook $book
     * @return Model
     */
    public function handle(WriteBook $book): Model
    {
         $result = $book->create([
            'description' => $this->description,
            'title' => $this->title,
        ]);

        return $book->attach($result, 'authors',$this->author_id);
    }
}
