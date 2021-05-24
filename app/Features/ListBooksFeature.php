<?php

declare(strict_types=1);

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
        $books = $this->run(GetListBooksJob::class, $request->only(['limit','column','desc']));

        return $this->run(RespondWithJsonJob::class, [
            'content' => $books
        ]);
    }
}
