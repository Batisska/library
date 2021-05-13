<?php

namespace Tests\Unit\Domains\Book\Jobs;

use App\Data\Models\Author;
use App\Data\Models\Book;
use App\Data\Repository\BookRepository;
use Tests\TestCase;
use App\Domains\Book\Jobs\UpdateBookJob;

class UpdateBookJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_update_book_job(): void
    {
        $authors = Author::factory()->count(2)->make();

        $book = Book::factory()->hasAttached($authors)->make();

        $title = $book->title.'_update';
        $description = $book->description.'_update';

        $job = new UpdateBookJob(1, $title, $description);

        $stub = $this->createMock(BookRepository::class);

        $stub->method('update')
            ->willReturn(1);

        $stub->method('find')
            ->willReturn([
                'title' => $title,
                'description' => $description,
                'authors' => $authors->toArray()
            ]);

        $result = $job->handle($stub);

        self::assertEquals($title,$result['title']);
        self::assertEquals($description,$result['description']);
        self::assertEquals($result['authors'],$authors->toArray());
    }
}
