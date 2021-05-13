<?php

namespace Tests\Features\Author;

use App\Data\Models\User;
use App\Data\Repository\Author\WriteAuthor;
use App\Features\DestroyAuthorFeature;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * Class DestroyAuthorFeatureTest
 * @package Tests\Feature
 * @see DestroyAuthorFeature
 */
class DestroyAuthorFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_destroy_author_feature(): void
    {
        $user = User::factory()->make();

        $this->instance(WriteAuthor::class, Mockery::mock(WriteAuthor::class, function (MockInterface $mock) {
            $mock->shouldReceive('destroy')->once()->andReturn(true);
        }));

        $this->actingAs($user)
             ->deleteJson(route('authors.destroy', 1))
             ->assertSuccessful()
             ->assertJsonPath('data', true);
    }
}
