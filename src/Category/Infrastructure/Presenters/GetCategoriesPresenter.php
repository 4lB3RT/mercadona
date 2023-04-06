<?php declare(strict_types=1);

namespace Mercadona\Category\Infrastructure\Presenters;

use Mercadona\Category\Domain\Category;
use Mercadona\Shared\Application\Response;
use Mercadona\Product\Infrastructure\Transformers\ProductDataTransformer;
use Mercadona\Category\Infrastructure\Repositories\Transformers\CategoryDataTransformer;
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