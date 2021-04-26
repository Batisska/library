<?php

namespace App\Domains\Book\Jobs;

use App\Data\Models\Book;
use App\Domains\Book\Requests\ListBooks;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Lucid\Units\Job;

class GetListBooksJob extends Job
{
    /**
     * @var ListBooks
     */
    private ListBooks $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ListBooks $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return LengthAwarePaginator
     */
    public function handle(): LengthAwarePaginator
    {
        return Book::orderBy($this->request->order ?? 'id', $this->request->order_desc ?? 'desc')
            ->paginate($this->request->limit ?? 10);
    }
}
