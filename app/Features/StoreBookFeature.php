<?php

declare(strict_types=1);

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
            'author_id' => $request->input('author_id'),
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $book
        ]);
    }
}
