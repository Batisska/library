<?php

namespace App\Features;

use App\Data\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class ShowBookFeature extends Feature
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
        return $this->run(RespondWithJsonJob::class,[
            'content' => $this->book
        ]);
    }
}
