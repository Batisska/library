<?php

namespace App\Providers;

use App\Data\Repository\Author\AuthorRepository;
use App\Data\Repository\Author\ReadAuthor;
use App\Data\Repository\Author\WriteAuthor;
use App\Data\Repository\Book\BookRepository;
use App\Data\Repository\Book\ReadBook;
use App\Data\Repository\Book\WriteBook;
use App\Data\Repository\User\ReadUser;
use App\Data\Repository\User\Token;
use App\Data\Repository\User\TokenRepository;
use App\Data\Repository\User\UserRepository;
use App\Data\Repository\User\WriteUser;
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

        $this->app->bind(ReadUser::class, UserRepository::class);
        $this->app->bind(WriteUser::class, UserRepository::class);

        $this->app->bind(Token::class, TokenRepository::class);
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
