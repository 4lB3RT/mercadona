<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Presenters\Category;

use Mercadona\Domain\Category\Category;
use Mercadona\Infrastructure\Domain\Category\CategoryDataTransformer;
use Mercadona\Infrastructure\Domain\Product\ProductDataTransformer;
use Mercadona\Shared\Application\Response;
use Mercadona\Shared\Infrastructure\Presenters\JsonPresenter;

final class GetCategoriesPresenter implements JsonPresenter
{ 
    public function toJson(Response $response): string
    {
        $categories = $response->categories();

        $categoriesArray = [];

        
        /** @var Category $category */
        foreach ($categories->items () as $category) {
            $products = ProductDataTransformer::fromEntities($category->products());
            
            $categoriesArray[] = [
                "id" => $category->id()->value(),
                "name" => $category->name()->value(),
                "status" => $category->status(),
                "categories" => CategoryDataTransformer::fromEntities($category->categories()),
                "products" => $products,
                "parentId" => $category->parentId()?->value(),
                "order" => $category->order(),
                "published" => $category->published(),
            ];
        }

        return json_encode([
            "categories" => [
                $categoriesArray
            ]
        ]);
    }
}