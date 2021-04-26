<?php

namespace App\Features;

use App\Data\Models\Author;
use App\Domains\Author\Jobs\DestroyAuthorJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class DestroyAuthorFeature extends Feature
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
        $destroy = $this->run(DestroyAuthorJob::class,[
            'author' => $this->author
        ]);

        return $this->run(RespondWithJsonJob::class,[
            'content' => $destroy
        ]);
    }
}
