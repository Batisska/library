<?php

declare(strict_types=1);

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
    public function __construct(string $column = 'id', string $desc = 'desc', int $limit = 10)
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
        return $book->paginate($this->column, $this->desc , $this->limit);
    }
}
