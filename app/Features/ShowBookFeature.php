<?php

namespace App\Features;

use App\Data\Models\Book;
use App\Domains\Book\Jobs\GetBookByIdJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class ShowBookFeature extends Feature
{
    private int $book_id;

    public function __construct(int $book_id)
    {
        $this->book_id = $book_id;
    }

    /**
     * @return JsonResponse
     */
    public function handle(): JsonResponse
    {
        $book = $this->run(GetBookByIdJob::class,[
            'book_id' => $this->book_id
        ]);

        return $this->run(RespondWithJsonJob::class,[
            'content' => $book
        ]);
    }
}
