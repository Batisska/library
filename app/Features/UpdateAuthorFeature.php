<?php

namespace App\Features;

use App\Data\Models\Author;
use App\Domains\Author\Jobs\UpdateAuthorJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class UpdateAuthorFeature extends Feature
{
    private Author $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function handle(Request $request): JsonResponse
    {
        $this->run(UpdateAuthorJob::class, [
            'author' => $this->author,
            'request' => $request,
        ]);

        return $this->run(RespondWithJsonJob::class,[
            'content' => $this->author
        ]);
    }
}
