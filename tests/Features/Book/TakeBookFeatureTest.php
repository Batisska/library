<?php

namespace Tests\Features\Book;

use App\Data\Models\Book;
use App\Data\Models\User;
use App\Data\Repository\User\ReadUser;
use App\Data\Repository\User\WriteUser;
use App\Domains\Book\Requests\TakeBookRequest;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * Class TakeBookFeatureTest
 * @package Tests\Features\Book
 */
class TakeBookFeatureTest extends TestCase
{
    public function test_take_book_feature(): void
    {
        $user = User::factory()->make();
        $book = Book::factory()->make();

        $book->id = 1;
        $user->id = 1;

        $data = [
            'book_id' => $book->id,
            'user_id' => $user->id,
            'return_at' => now()->format('Y-m-d H:i:s'),
        ];

          $user->setRelation('books', [$book]);

          $book->id = 1;
          $user->id = 1;


          $request = TakeBookRequest::create(route('take.book.store', $data), 'POST');
          $this->instance(TakeBookRequest::class, $request);

          $this->instance(WriteUser::class, Mockery::mock(WriteUser::class, function (MockInterface $mock) use ($user): void {
              $mock->shouldReceive('attach')->once()->andReturn($user);
          }));

          $this->instance(ReadUser::class, Mockery::mock(ReadUser::class, function (MockInterface $mock) use ($user): void {
              $mock->shouldReceive('find')->andReturn($user);
          }));

        $this->actingAs($user)
             ->postJson(route('take.book.store', $data))
             ->assertSuccessful()
             ->assertJsonPath('data.id', $user->id)
             ->assertJsonPath('data.name', $user->name)
             ->assertJsonPath('data.email', $user->email)
//             ->assertJsonPath('data.books.*.id', [$book->id])
//             ->assertJsonPath('data.books.*.pivot.user_id', [(string)$user->id])
        ;
    }
}
