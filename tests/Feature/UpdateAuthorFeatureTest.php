<?php

namespace Tests\Feature;

use App\Data\Models\Author;
use App\Data\Models\User;
use App\Domains\Author\Jobs\UpdateAuthorJob;
use Tests\TestCase;
use App\Features\UpdateAuthorFeature;

/**
 * Class UpdateAuthorFeatureTest
 * @package Tests\Feature
 * @see UpdateAuthorFeature
 * @see UpdateAuthorJob
 */
class UpdateAuthorFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_update_author_feature(): void
    {
        $this->withoutExceptionHandling();

        $author = Author::factory()->create();

        $user = User::factory()->create();

        $this->actingAs($user)->putJson(route('authors.update',$author->id), [
            'first_name' => $author->first_name.'_update',
            'last_name' => $author->last_name.'_update',
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.last_name', $author->last_name.'_update')
            ->assertJsonPath('data.first_name', $author->first_name.'_update')
        ;
    }
}
