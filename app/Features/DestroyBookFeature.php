<?php

declare(strict_types=1);

namespace App\Features;

use App\Data\Models\Book;
use App\Domains\Book\Jobs\DestroyBookJob;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class DestroyBookFeature extends Feature
{
    /**
     * @var int
     */
    private int $book_id;

    /**
     * DestroyBookFeature constructor.
     * @param int $book_id
     */
    public function __construct(int $book_id)
    {
        $this->book_id = $book_id;
    }

    /**
     * @return JsonResponse
     */
    public function handle(): JsonResponse
    {
        $destroy = $this->run(DestroyBookJob::class, [
            'book_id' => $this->book_id
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $destroy
        ]);
    }
}
