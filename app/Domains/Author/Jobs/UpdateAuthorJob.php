<?php

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
use Lucid\Units\Job;

class UpdateAuthorJob extends Job
{
    /**
     * @var Author
     */
    private Author $author;

    /**
     * @var string
     */
    private string $first_name;

    /**
     * @var string
     */
    private string $last_name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Author $author, string $first_name, string $last_name)
    {
        $this->author = $author;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        return $this->author->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);
    }
}
