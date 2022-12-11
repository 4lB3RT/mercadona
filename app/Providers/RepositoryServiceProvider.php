<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mercadona\Domain\Category\CategoryReadRepository;
use Mercadona\Domain\Category\CategoryRepository;
use Mercadona\Domain\Photo\PhotoRepository;
use Mercadona\Domain\Price\PriceRepository;
use Mercadona\Domain\Product\ProductReadRepository;
use Mercadona\Domain\Product\ProductRepository;
use Mercadona\Infrastructure\Domain\Category\ApiCategoryRepository;
use Mercadona\Infrastructure\Domain\Product\ApiProductRepository;
use Mercadona\Infrastructure\Domain\Category\EloquentCategoryRepository;
use Mercadona\Infrastructure\Domain\Photo\EloquentPhotoRepository;
use Mercadona\Infrastructure\Domain\Price\EloquentPriceRepository;
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
            CategoryReadRepository::class,
            ApiCategoryRepository::class
        );

        $this->app->bind(
            ProductRepository::class,
            EloquentProductRepository::class
        );
        
        $this->app->bind(
            ProductReadRepository::class,
            ApiProductRepository::class
        );

        $this->app->bind(
            PriceRepository::class,
            EloquentPriceRepository::class
        );

        $this->app->bind(
            PhotoRepository::class,
            EloquentPhotoRepository::class
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

