<?php declare(strict_types=1);

namespace Mercadona\Category\Infrastructure\Presenters;

use Mercadona\Category\Application\GetCategory\GetCategoryResponse;
use Mercadona\Category\Domain\CategoryCollection;
use Mercadona\Domain\Category\Category;
use Mercadona\Shared\Application\Response;
use Mercadona\Shared\Infrastructure\Presenters\JsonPresenter;
use Mercadona\Product\Infrastructure\Transformers\ProductDataTransformer;

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
                "categories" => $this->childrenCategories($category->categories()),
                "products" => $products
            ]
        ]);
    }

    public function childrenCategories(CategoryCollection $categories): array 
    {
        $categoriesArray = [];

        /** @var Category $category */
        foreach ($categories as $category) {            
            $categoriesArray[] =  [
                "id" => $category->id()->value(),
                "category_id" => $category->parentId()?->value(),
                "name" => $category->name()->value(),
                "categories" => $this->childrenCategories($category->categories()),
                "status" => $category->status()->name,
                "is_parent" => $category->isParent(),
                "order" => $category->order(),
                "published" => $category->published(),
            ];
        }

        return $categoriesArray;
    }
}