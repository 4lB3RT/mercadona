<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mercadona\Domain\Category\Service\FindAndSaveCategory;
use Mercadona\Domain\Category\Service\FindAndSaveCategoryService;
use Mercadona\Domain\Product\Service\SaveProduct;
use Mercadona\Domain\Product\Service\SaveProductService;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
           FindAndSaveCategory::class,
           FindAndSaveCategoryService::class
        );

        $this->app->bind(
            SaveProduct::class,
            SaveProductService::class
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

