<?php

namespace App\Features;

use App\Domains\Book\Jobs\TakeBookJob;
use App\Domains\Book\Requests\TakeBookRequest;
use Illuminate\Http\JsonResponse;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

/**
 * Class TakeBookFeature
 * @package App\Features
 */
class TakeBookFeature extends Feature
{
    /**
     * @param TakeBookRequest $request
     * @return JsonResponse
     */
    public function handle(TakeBookRequest $request): JsonResponse
    {
        $user = $this->run(TakeBookJob::class, [
           'user_id' => $request->input('user_id'),
           'book_id' => $request->input('book_id'),
           'return_at' => $request->input('return_at'),
        ]);

        return $this->run(RespondWithJsonJob::class,[
            'content' => $user
        ]);
    }
}
