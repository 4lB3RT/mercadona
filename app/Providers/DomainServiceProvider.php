<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mercadona\Domain\Category\Service\FindAndSaveCategory;
use Mercadona\Domain\Category\Service\FindAndSaveCategoryService;

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

