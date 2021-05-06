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
    private int $book_id;

    public function __construct(int $book_id)
    {
        $this->book_id = $book_id;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function handle(Request $request): JsonResponse
    {
        $book = $this->run(UpdateBookJob::class,[
            'book_id' => $this->book_id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return $this->run(RespondWithJsonJob::class,[
            'content' => $book
        ]);
    }
}
