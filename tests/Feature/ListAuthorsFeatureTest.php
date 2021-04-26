<?php

namespace Tests\Feature;

use App\Data\Models\Author;
use App\Data\Models\User;
use Tests\TestCase;

class ListAuthorsFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_list_authors_feature(): void
    {
        Author::factory()->count(10)->create();

        $user = User::factory()->create();

        $this->actingAs($user)->getJson(route('authors.index',[
            'limit' => 5,
            'order' => 'first_name',
            'orderBy' => 'desc',
        ]))
            ->assertJsonCount(5,'data.data')
            ->assertSuccessful();
    }
}
