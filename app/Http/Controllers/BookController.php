<?php

namespace App\Http\Controllers;

use App\Data\Models\Book;
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
    public function index(): JsonResponse
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
     * @param Book $book
     * @return JsonResponse
     */
    public function show(Request $request, Book $book): JsonResponse
    {
        return $this->serve(ShowBookFeature::class,[
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function update(Book $book): JsonResponse
    {
        return $this->serve(UpdateBookFeature::class,[
            'book' => $book
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function destroy(Book $book): JsonResponse
    {
        return $this->serve(DestroyBookFeature::class,[
            'book' => $book
        ]);
    }
}
