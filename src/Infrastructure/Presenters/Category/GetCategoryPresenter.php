<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Presenters\Category;

use Mercadona\Domain\Category\Category;
use Mercadona\Domain\Product\Product;
use Mercadona\Infrastructure\Domain\Category\CategoryDataTransformer;
use Mercadona\Infrastructure\Domain\Product\ProductDataTransformer;
use Mercadona\Shared\Application\Response;
use Mercadona\Shared\Infrastructure\Presenters\JsonPresenter;

final class GetCategoryPresenter implements JsonPresenter
{ 
    public function toJson(Response $response): string
    {
        /** @var Category $category */
        $category = $response->category;

        $products = ProductDataTransformer::fromEntities($category->products());
        
        return json_encode([
            "category" => [
                "id" => $category->id->value,
                "parentId" => $category->parentId?->value,
                "name" => $category->name->value,
                "status" => $category->status(),
                "published" => $category->published,
                "order" => $category->order,
                "categories" => CategoryDataTransformer::fromEntities($category->categories()),
                "products" => $products
            ]
        ]);
    }
}