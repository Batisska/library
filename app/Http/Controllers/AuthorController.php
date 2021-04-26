<?php

namespace App\Http\Controllers;

use App\Data\Models\Author;
use App\Features\DestroyAuthorFeature;
use App\Features\ListAuthorsFeature;
use App\Features\ShowAuthorFeature;
use App\Features\StoreAuthorFeature;
use App\Features\UpdateAuthorFeature;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->serve(ListAuthorsFeature::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        return $this->serve(StoreAuthorFeature::class);
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return JsonResponse
     */
    public function show(Author $author): JsonResponse
    {
        return $this->serve(ShowAuthorFeature::class,[
            'author' => $author
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Author $author
     * @return JsonResponse
     */
    public function update(Author $author): JsonResponse
    {
        return $this->serve(UpdateAuthorFeature::class,[
            'author' => $author
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Author $author
     * @return JsonResponse
     */
    public function destroy(Author $author): JsonResponse
    {
        return $this->serve(DestroyAuthorFeature::class,[
            'author' => $author
        ]);
    }
}
