<?php

namespace App\Features;

use App\Domains\Book\Jobs\GetListBooksJob;
use App\Domains\Book\Requests\ListBooks;
use Illuminate\Http\JsonResponse;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class ListBooksFeature extends Feature
{
    /**
     * @param ListBooks $request
     * @return JsonResponse
     */
    public function handle(ListBooks $request): JsonResponse
    {
        $books = $this->run(GetListBooksJob::class,[
            'column' => $request->input('column'),
            'desc' => $request->input('desc'),
            'limit' => $request->input('limit'),
        ]);

       return $this->run(RespondWithJsonJob::class,[
            'content' => $books
        ]);
    }
}
