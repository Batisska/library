<?php

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
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
     * @param Author $author
     * @return mixed
     */
    public function handle(Author $author): mixed
    {
        $author->where('id',$this->author_id)->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);

        return $author->where('id',$this->author_id)->first();
    }
}
