<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mercadona\Category\Domain\Service\FindAndSaveCategory;
use Mercadona\Category\Domain\Service\FindAndSaveCategoryService;

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

