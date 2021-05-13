<?php

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
use App\Data\Repository\Author\WriteAuthor;
use Illuminate\Database\Eloquent\Model;
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
     * @param string $first_name
     * @param string $last_name
     */
    public function __construct(string $first_name, string $last_name)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    /**
     * Execute the job.
     *
     * @param WriteAuthor $author
     * @return Model
     */
    public function handle(WriteAuthor $author): Model
    {
        return $author->create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);
    }
}
