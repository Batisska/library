<?php

namespace App\Features;

use App\Domains\Author\Jobs\GetAuthorJob;
use Illuminate\Http\JsonResponse;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class ShowAuthorFeature extends Feature
{
    private int $author_id;

    public function __construct(int $author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * @return JsonResponse
     */
    public function handle(): JsonResponse
    {
        $author = $this->run(GetAuthorJob::class,[
            'author_id' => $this->author_id
        ]);

        return $this->run(RespondWithJsonJob::class,[
            'content' => $author
        ]);
    }
}
