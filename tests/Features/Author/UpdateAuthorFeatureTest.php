<?php

namespace Tests\Features\Author;

use App\Data\Models\Author;
use App\Data\Models\User;
use App\Data\Repository\Author\ReadAuthor;
use App\Data\Repository\Author\WriteAuthor;
use App\Domains\Author\Jobs\UpdateAuthorJob;
use App\Features\UpdateAuthorFeature;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

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
        $author = Author::factory()->make();

        $this->instance(WriteAuthor::class,
            Mockery::mock(WriteAuthor::class, function (MockInterface $mock) {
            $mock->shouldReceive('update')->andReturn(true);
        }));

        $this->instance(ReadAuthor::class,
            Mockery::mock(ReadAuthor::class, function (MockInterface $mock) use ($author) {
                $mock->shouldReceive('find')->andReturn($author);
            }));

        $user = User::factory()->make();

        $this->actingAs($user)
             ->putJson(route('authors.update', 1), [
                 'first_name' => $author->first_name,
                 'last_name' => $author->last_name,
             ])
             ->assertSuccessful()
             ->assertJsonPath('data.last_name', $author->last_name)
             ->assertJsonPath('data.first_name', $author->first_name);
    }
}
