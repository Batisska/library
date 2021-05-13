<?php

namespace App\Providers;

use App\Data\Repository\Author\AuthorRepository;
use App\Data\Repository\Author\ReadAuthor;
use App\Data\Repository\Author\WriteAuthor;
use App\Data\Repository\Book\BookRepository;
use App\Data\Repository\Book\ReadBook;
use App\Data\Repository\Book\WriteBook;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ReadBook::class, BookRepository::class);
        $this->app->bind(WriteBook::class, BookRepository::class);

        $this->app->bind(ReadAuthor::class, AuthorRepository::class);
        $this->app->bind(WriteAuthor::class, AuthorRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
