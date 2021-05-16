<?php

declare(strict_types=1);

namespace Tests\Features\Book;

use App\Data\Models\Book;
use App\Data\Models\User;
use App\Data\Repository\Book\WriteBook;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class DestroyBookFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_destroy_book_feature(): void
    {
        Book::factory()->make();

        $this->instance(WriteBook::class, Mockery::mock(WriteBook::class, function (MockInterface $mock): void {
            $mock->shouldReceive('destroy')->once()->andReturn(true);
        }));

        $user = User::factory()->make();

        $this->actingAs($user)
            ->deleteJson(route('books.destroy', 1))
            ->assertSuccessful()
            ->assertJsonPath('data', true);
    }
}
