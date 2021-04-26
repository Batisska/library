<?php

namespace Tests\Feature;

use App\Data\Models\Author;
use App\Data\Models\User;
use Tests\TestCase;

class ShowAuthorFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_show_author_feature(): void
    {
        $author = Author::factory()->create();

        $user = User::factory()->create();

        $this->actingAs($user)->getJson(route('authors.show', $author->id))
            ->assertSuccessful()
            ->assertJsonPath('data.id',$author->id)
        ;
    }
}
