<?php

namespace App\Domains\Author\Jobs;

use App\Data\Models\Author;
use App\Domains\Author\Requests\ListAuthors;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Lucid\Units\Job;

class GetListAuthorsJob extends Job
{
    private ListAuthors $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ListAuthors $request)
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
        return Author::orderBy($this->request->order ?? 'id', $this->request->order_desc ?? 'desc')
            ->paginate($this->request->limit ?? 10);
    }
}
