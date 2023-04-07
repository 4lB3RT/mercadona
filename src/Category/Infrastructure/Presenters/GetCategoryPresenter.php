<?php declare(strict_types=1);

namespace Mercadona\Category\Infrastructure\Presenters;

use Mercadona\Category\Application\GetCategory\GetCategoryResponse;
use Mercadona\Domain\Category\Category;
use Mercadona\Shared\Application\Response;
use Mercadona\Shared\Infrastructure\Presenters\JsonPresenter;
use Mercadona\Product\Infrastructure\Transformers\ProductDataTransformer;
use Mercadona\Category\Infrastructure\Transformers\CategoryDataTransformer;

final class GetCategoryPresenter implements JsonPresenter
{ 
    /** @param GetCategoryResponse @response*/
    public function toJson(Response $response): string
    {
        /** @var Category $category */
        $category = $response->category();

        $products = ProductDataTransformer::fromEntities($category->products());
        
        return json_encode([
            "category" => [
                "id" => $category->id()->value(),
                "parentId" => $category->parentId()?->value(),
                "name" => $category->name()->value(),
                "status" => $category->status(),
                "published" => $category->published(),
                "order" => $category->order(),
                "categories" => CategoryDataTransformer::fromEntities($category->categories()),
                "products" => $products
            ]
        ]);
    }
}