<?php declare(strict_types=1);

namespace Mercadona\Category\Infrastructure\Presenters;

use Mercadona\Category\Application\GetCategories\GetCategoriesResponse;
use Mercadona\Category\Domain\Category;
use Mercadona\Category\Domain\CategoryCollection;
use Mercadona\Shared\Application\Response;
use Mercadona\Shared\Infrastructure\Presenters\JsonPresenter;

final class GetCategoriesPresenter implements JsonPresenter
{ 
    /** @param GetCategoriesResponse $response */
    public function toJson(Response $response): string
    {
        $categories = $response->categories();

        $categoriesArray = [];

         /** @var Category $category */
        foreach ($categories->items () as $category) {  
            $categoriesArray[] = [
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

        return json_encode([
            "categories" => [
                $categoriesArray
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