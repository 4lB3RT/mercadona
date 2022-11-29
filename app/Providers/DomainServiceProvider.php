<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mercadona\Domain\Category\Service\FindCategoriesAndSave;
use Mercadona\Domain\Category\Service\FindCategoriesAndSaveService;

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
           FindCategoriesAndSave::class,
           FindCategoriesAndSaveService::class
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

