<?php

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
use Lucid\Units\Job;

class SaveAuthorJob extends Job
{
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
    public function __construct(string $first_name, string $last_name)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    /**
     * Execute the job.
     *
     * @return Author
     */
    public function handle(): Author
    {
        return Author::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);
    }
}
