<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Features\DestroyBookFeature;
use App\Features\ListBooksFeature;
use App\Features\ShowBookFeature;
use App\Features\StoreBookFeature;
use App\Features\UpdateBookFeature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->serve(ListBooksFeature::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        return $this->serve(StoreBookFeature::class);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $book_id
     * @return JsonResponse
     */
    public function show(Request $request, int $book_id): JsonResponse
    {
        return $this->serve(ShowBookFeature::class, [
            'book_id' => $book_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $book_id
     * @return JsonResponse
     */
    public function update(int $book_id): JsonResponse
    {
        return $this->serve(UpdateBookFeature::class, [
            'book_id' => $book_id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $book_id
     * @return JsonResponse
     */
    public function destroy(int $book_id): JsonResponse
    {
        return $this->serve(DestroyBookFeature::class, [
            'book_id' => $book_id
        ]);
    }
}
