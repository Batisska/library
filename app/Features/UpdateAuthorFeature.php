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
    /**
     * @var int
     */
    private int $author_id;

    public function __construct(int $author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function handle(Request $request): JsonResponse
    {
        $author = $this->run(UpdateAuthorJob::class, [
            'author_id' => $this->author_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        return $this->run(RespondWithJsonJob::class,[
            'content' => $author
        ]);
    }
}
