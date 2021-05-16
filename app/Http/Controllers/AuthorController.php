<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->serve(ShowAuthorFeature::class, [
            'author_id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function update(int $id): JsonResponse
    {
        return $this->serve(UpdateAuthorFeature::class, [
            'author_id' => $id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->serve(DestroyAuthorFeature::class, [
            'author_id' => $id
        ]);
    }
}
