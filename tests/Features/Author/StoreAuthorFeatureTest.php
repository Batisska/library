<?php

namespace Tests\Features\Author;

use App\Data\Models\Author;
use App\Data\Models\User;
use App\Data\Repository\Author\WriteAuthor;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class StoreAuthorFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_store_author_feature(): void
    {
        $author = Author::factory()->make();

        $this->instance(WriteAuthor::class,
            Mockery::mock(WriteAuthor::class, function (MockInterface $mock) use ($author) {
                $mock->shouldReceive('create')->once()->andReturn($author);
            }));


        $user = User::factory()->make();

        $this->actingAs($user)
             ->postJson(route('authors.store'), [
                 'first_name' => $author->first_name,
                 'last_name' => $author->last_name,
             ])
             ->assertSuccessful()
             ->assertJsonPath('data.last_name', $author->last_name)
             ->assertJsonPath('data.first_name', $author->first_name);
    }
}
