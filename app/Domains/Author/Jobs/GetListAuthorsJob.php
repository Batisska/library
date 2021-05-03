<?php

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Lucid\Units\Job;

class GetListAuthorsJob extends Job
{
    /**
     * @var string
     */
    private string $column;

    /**
     * @var string
     */
    private string $desc;

    /**
     * @var int
     */
    private int $limit;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $column, string $desc, int $limit)
    {
        $this->column = $column;
        $this->desc = $desc;
        $this->limit = $limit;
    }

    /**
     * Execute the job.
     *
     * @param Author $author
     * @return LengthAwarePaginator
     */
    public function handle(Author $author): LengthAwarePaginator
    {
        return $author->orderBy($this->column ?? 'id', $this->desc ?? 'desc')
            ->paginate($this->limit ?? 10);
    }
}
