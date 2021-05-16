<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Book\Jobs;

use App\Data\Models\Author;
use App\Data\Models\Book;
use App\Data\Repository\Book\BookRepository;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Domains\Book\Jobs\SaveBookJob;

class SaveBookJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_save_book_job(): void
    {
        $authors = Author::factory()->count(2)->make();

        $book = Book::factory()->hasAttached($authors)->make();

        $book->setRelation('authors', $authors);

        $job = new SaveBookJob($book->title, $book->description, $authors->pluck('id')->toArray());

        $stub = $this->createMock(BookRepository::class);

        $stub->method('create')
            ->willReturn($book);

        $stub->method('attach')
            ->willReturn($book);

        $result = $job->handle($stub);

        self::assertEquals($book->title, $result['title']);
        self::assertEquals($book->description, $result['description']);
        self::assertEquals($authors->pluck('first_name')->toArray(), $result['authors']->pluck('first_name')->toArray());
    }
}
