<?php

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
use Lucid\Units\Job;

class SaveAuthorJob extends Job
{
    private array $input;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $input)
    {
        $this->input = $input;
    }

    /**
     * Execute the job.
     *
     * @return Author
     */
    public function handle(): Author
    {
        return Author::create($this->input);
    }
}
