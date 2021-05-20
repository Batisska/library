<?php

namespace Tests\Unit\Domains\Book\Jobs;

use App\Data\Models\Book;
use App\Data\Models\User;
use App\Data\Repository\User\UserRepository;
use Tests\TestCase;
use App\Domains\Book\Jobs\TakeBookJob;

class TakeJobTest extends TestCase
{
    public function test_take_job(): void
    {
        $user = User::factory()->make();
        $book = Book::factory()->make();

        $user->id = 1;
        $book->id = 1;

        $user->setRelation('books',[$book]);

        $job = new TakeBookJob($user->id,$book->id,now()->format('Y-m-d H:i:s'));

        $stub = $this->createMock(UserRepository::class);

        $stub->method('find')
             ->willReturn($user);

        $stub->method('attach')
             ->willReturn($user);

        $user = $job->handle($stub,$stub);

        self::assertEquals($book->id, $user['books'][0]['id']);

    }
}
