<?php

namespace Tests\Feature;

use App\Data\Models\Author;
use App\Data\Models\User;
use Tests\TestCase;

class DestroyAuthorFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_destroy_author_feature(): void
    {
        $author = Author::factory()->create();

        $user = User::factory()->create();

        $this->actingAs($user)->deleteJson(route('authors.destroy', $author->id))
            ->assertSuccessful();

        $this->assertSoftDeleted((new Author)->getTable(), [
            'id' => $author->id
        ]);
    }
}