<?php

namespace App\Domains\Book\Jobs;

use App\Data\Repository\Book\ReadBook;
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
     * @param string $column
     * @param string $desc
     * @param int $limit
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
     * @param ReadBook $book
     * @return LengthAwarePaginator
     */
    public function handle(ReadBook $book): LengthAwarePaginator
    {
        return $book->paginate($this->column ?? 'id', $this->desc ?? 'desc',$this->limit ?? 10);
    }
}
