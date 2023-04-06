<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mercadona\Photo\Domain\PhotoRepository;
use Mercadona\Price\Domain\PriceRepository;
use Mercadona\Product\Domain\ProductRepository;
use Mercadona\Category\Domain\CategoryRepository;
use Mercadona\Product\Domain\ProductReadRepository;
use Mercadona\Category\Domain\CategoryReadRepository;
use Mercadona\Product\Infrastructure\Repositories\Api\ApiProductRepository;
use Mercadona\Category\Infrastructure\Repositories\Api\ApiCategoryRepository;
use Mercadona\Photo\Infrastructure\Repositories\Eloquent\EloquentPhotoRepository;
use Mercadona\Price\Infrastructure\Repositories\Eloquent\EloquentPriceRepository;
use Mercadona\Product\Infrastructure\Repositories\Eloquent\EloquentProductRepository;
use Mercadona\Category\Infrastructure\Repositories\Eloquent\EloquentCategoryRepository;

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

