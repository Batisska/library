<?php

namespace App\Features;

use App\Data\Models\Author;
use App\Domains\Author\Jobs\GetAuthorJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class ShowAuthorFeature extends Feature
{
    private Author $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    /**
     * @return JsonResponse
     */
    public function handle(): JsonResponse
    {
        $author = $this->run(GetAuthorJob::class,[
            'author' => $this->author
        ]);

        return $this->run(RespondWithJsonJob::class,[
            'content' => $author
        ]);
    }
}
