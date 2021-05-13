<?php

namespace Tests\Features\Book;

use App\Data\Models\Book;
use App\Data\Models\User;
use App\Data\Repository\Book\ReadBook;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class ListBooksFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_list_books_feature(): void
    {
        $books = Book::factory()->count(5)->make();

        $this->instance(ReadBook::class, Mockery::mock(ReadBook::class, function (MockInterface $mock) use ($books) {
            $paginator = new LengthAwarePaginator(items: $books, total: 10, perPage: 5);
            $mock->shouldReceive('paginate')->once()->andReturn($paginator);
        }));

        $user = User::factory()->make();

        $this->actingAs($user)->getJson(route('books.index',[
            'limit' => 5,
            'column' => 'title',
            'desc' => 'desc',
        ]))
            ->assertJsonCount(5,'data.data')
            ->assertSuccessful();
    }
}
