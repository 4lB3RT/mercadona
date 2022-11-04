<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mercadona\Domain\Category\CategoryRepository;
use Mercadona\Domain\Category\FinderCategoryRepository;
use Mercadona\Domain\Product\ProductRepository;
use Mercadona\Infrastructure\Domain\Category\ApiFinderCategoryRepository;
use Mercadona\Infrastructure\Domain\Product\ApiFinderProductRepository;
use Mercadona\Infrastructure\Domain\Category\EloquentCategoryRepository;
use Mercadona\Infrastructure\Domain\Product\EloquentProductRepository;

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

        $this->app->bind(
            ProductRepository::class,
            EloquentProductRepository::class
        );
         $this->app->bind(
             FinderProductRepository::class,
             ApiFinderProductRepository::class
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

