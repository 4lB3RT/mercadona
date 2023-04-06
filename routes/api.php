<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mercadona\Product\Infrastructure\Controllers\GetProductController;
use Mercadona\Product\Infrastructure\Controllers\GetProductsController;
use Mercadona\Category\Infrastructure\Controllers\GetCategoryController;
use Mercadona\Category\Infrastructure\Controllers\GetCategoriesController;

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
    Route::get('/', GetProductsController::class)->name("categories");
    Route::get('/{productId}', GetProductController::class)->name("category");
});