<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mercadona\Domain\Category\CategoryRepository;
use Mercadona\Domain\Category\FinderCategoryRepository;
use Mercadona\Infrastructure\Domain\Category\ApiFinderCategoryRepository;
use Mercadona\Infrastructure\Domain\Category\EloquentCategoryRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(
           CategoryRepository::class,
           EloquentCategoryRepository::class
       );
        $this->app->bind(
            FinderCategoryRepository::class,
            ApiFinderCategoryRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

