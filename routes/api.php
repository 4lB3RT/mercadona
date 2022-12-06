<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mercadona\Application\Category\GetCategories\GetCategories;
use Mercadona\Application\Category\GetCategory\GetCategory;
use Mercadona\Infrastructure\Controllers\Category\GetCategoriesController;
use Mercadona\Infrastructure\Controllers\Category\GetCategoryController;
use Mercadona\Infrastructure\Controllers\Product\GetProductController;
use Mercadona\Infrastructure\Controllers\Product\GetProductsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'categories'], function(){
    Route::get('/', GetCategoriesController::class)->name("categories");
    Route::get('/{categoryId}', GetCategoryController::class)->name("category");
});

Route::group(['prefix'=>'products'], function(){
    Route::get('/', GetCategoriesController::class)->name("categories");
    Route::get('/{categoryId}', GetProductController::class)->name("category");
});