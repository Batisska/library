<?php

namespace App\Domains\Book\Jobs;

use App\Data\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Lucid\Units\Job;

class GetListBooksJob extends Job
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
     * @param Book $book
     * @return LengthAwarePaginator
     */
    public function handle(Book $book): LengthAwarePaginator
    {
        return $book->orderBy($this->column ?? 'id', $this->desc ?? 'desc')
            ->paginate($this->limit ?? 10);
    }
}