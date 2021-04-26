<?php

namespace App\Features;

use App\Data\Models\Book;
use App\Domains\Book\Jobs\DestroyBookJob;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class DestroyBookFeature extends Feature
{
    private Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * @return JsonResponse
     */
    public function handle(): JsonResponse
    {
        $destroy = $this->run(DestroyBookJob::class,[
            'book' => $this->book
        ]);

        return $this->run(RespondWithJsonJob::class,[
            'content' => $destroy
        ]);
    }
}
