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
    private string $description;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Execute the job.
     *
     * @return Book
     */
    public function handle(): Book
    {
        return Book::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }
}
