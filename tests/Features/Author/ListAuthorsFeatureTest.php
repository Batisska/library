<?php

namespace Tests\Features\Author;

use App\Data\Models\Author;
use App\Data\Models\User;
use App\Data\Repository\Author\ReadAuthor;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class ListAuthorsFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_list_authors_feature(): void
    {
        $authors = Author::factory()->count(5)->make();

        $this->instance(ReadAuthor::class, Mockery::mock(ReadAuthor::class, function (MockInterface $mock) use ($authors) {
            $paginator = new LengthAwarePaginator(items: $authors, total: 10, perPage: 5);
            $mock->shouldReceive('paginate')->once()->andReturn($paginator);
        }));

        $user = User::factory()->make();

        $this->actingAs($user)->getJson(route('authors.index',[
            'limit' => 5,
            'column' => 'first_name',
            'desc' => 'desc',
        ]))
            ->assertJsonCount(5,'data.data')
            ->assertSuccessful();
    }
}
