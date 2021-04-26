<?php

namespace App\Features;

use App\Domains\Book\Jobs\SaveBookJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class StoreBookFeature extends Feature
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function handle(Request $request): JsonResponse
    {
        $book = $this->run(SaveBookJob::class, [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return $this->run(RespondWithJsonJob::class,[
            'content' => $book
        ]);
    }
}
