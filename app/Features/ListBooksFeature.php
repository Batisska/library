<?php

namespace App\Features;

use App\Data\Models\Book;
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
          'request' => $request
        ]);

       return $this->run(RespondWithJsonJob::class,[
            'content' => $books
        ]);
    }
}
