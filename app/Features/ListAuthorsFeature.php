<?php

namespace App\Features;

use App\Domains\Author\Jobs\GetListAuthorsJob;
use App\Domains\Author\Requests\ListAuthors;
use Illuminate\Http\JsonResponse;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class ListAuthorsFeature extends Feature
{
    /**
     * @param ListAuthors $request
     * @return JsonResponse
     */
    public function handle(ListAuthors $request): JsonResponse
    {
        $books = $this->run(GetListAuthorsJob::class,[
            'column' => $request->input('column'),
            'desc' => $request->input('desc'),
            'limit' => $request->input('limit'),
        ]);

        return $this->run(RespondWithJsonJob::class,[
            'content' => $books
        ]);
    }
}
