<?php

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
use Illuminate\Http\Request;
use Lucid\Units\Job;

class UpdateAuthorJob extends Job
{
    private Author $author;
    private Request $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Author $author, Request $request)
    {
        $this->author = $author;
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        return $this->author->update([
            'first_name' => $this->request->first_name,
            'last_name' => $this->request->last_name,
        ]);
    }
}
