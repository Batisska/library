<?php

namespace Tests\Feature;

use App\Data\Models\Author;
use App\Data\Models\User;
use Tests\TestCase;

class StoreAuthorFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_store_author_feature(): void
    {
        $author = Author::factory()->make();

        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('authors.store'), [
            'first_name' => $author->first_name,
            'last_name' => $author->last_name,
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.last_name', $author->last_name)
            ->assertJsonPath('data.first_name', $author->first_name)
        ;
    }
}
