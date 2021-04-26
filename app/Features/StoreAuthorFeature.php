<?php

namespace App\Features;

use App\Domains\Author\Jobs\SaveAuthorJob;
use App\Domains\Author\Requests\StoreAuthor;
use Illuminate\Http\JsonResponse;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class StoreAuthorFeature extends Feature
{
    /**
     * @param StoreAuthor $request
     * @return JsonResponse
     */
    public function handle(StoreAuthor $request): JsonResponse
    {
        $author = $this->run(SaveAuthorJob::class,[
            'input' => $request->input()
        ]);

        return $this->run(RespondWithJsonJob::class,[
            'content' => $author
        ]);
    }
}
