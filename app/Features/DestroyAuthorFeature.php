<?php

declare(strict_types=1);

namespace App\Features;

use App\Data\Models\Author;
use App\Domains\Author\Jobs\DestroyAuthorJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class DestroyAuthorFeature extends Feature
{
    /**
     * @var int
     */
    private int $author_id;

    /**
     * DestroyAuthorFeature constructor.
     * @param int $author_id
     */
    public function __construct(int $author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * @return JsonResponse
     */
    public function handle(): JsonResponse
    {
        $destroy = $this->run(DestroyAuthorJob::class, [
            'author_id' => $this->author_id
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $destroy
        ]);
    }
}
