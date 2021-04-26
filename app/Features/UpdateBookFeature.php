<?php

namespace App\Features;

use App\Data\Models\Book;
use App\Domains\Book\Jobs\UpdateBookJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class UpdateBookFeature extends Feature
{
    private Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function handle(Request $request): JsonResponse
    {
        $this->run(UpdateBookJob::class,[
            'book' => $this->book,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return $this->run(RespondWithJsonJob::class,[
            'content' => $this->book
        ]);
    }
}
