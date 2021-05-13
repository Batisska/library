<?php

namespace App\Providers;

use App\Data\Repository\BookRepository;
use App\Data\Repository\ReadBook;
use App\Data\Repository\WriteBook;
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
