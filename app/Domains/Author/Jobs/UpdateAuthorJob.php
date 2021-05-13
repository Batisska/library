<?php

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
use App\Data\Repository\Author\ReadAuthor;
use App\Data\Repository\Author\WriteAuthor;
use Lucid\Units\Job;

class UpdateAuthorJob extends Job
{
    /**
     * @var int
     */
    private int $author_id;

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
     * @param int $author_id
     * @param string $first_name
     * @param string $last_name
     */
    public function __construct(int $author_id, string $first_name, string $last_name)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->author_id = $author_id;
    }


    /**
     * @param WriteAuthor $writeAuthor
     * @param ReadAuthor $readAuthor
     * @return mixed
     */
    public function handle(WriteAuthor $writeAuthor, ReadAuthor $readAuthor): mixed
    {
        $writeAuthor->update($this->author_id,[
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);

        return $readAuthor->find($this->author_id);
    }
}
