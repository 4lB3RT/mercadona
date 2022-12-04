<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Presenters\Category;

use Mercadona\Shared\Application\Response;
use Mercadona\Shared\Infrastructure\Presenters\JsonPresenter;

final class GetCategoriesPresenter implements JsonPresenter
{ 
    public function toJson(Response $response): array
    {
        $categories = $response->categories;

        $categoriesArray = [];

        /** @var Category $category */
        foreach ($categories->items () as $category) {
            $categoriesArray[] = [
                "id" => $category->id()->value,
                "parentId" => $category->parentId()?->value,
                "name" => $category->name()->value,
                "status" => $category->status(),
                "published" => $category->published(),
                "order" => $category->order()
            ];
        }

        return [
            "categories" => [
                $categoriesArray
            ]
        ];
    }
}