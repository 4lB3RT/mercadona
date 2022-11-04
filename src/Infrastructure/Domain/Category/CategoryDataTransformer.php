<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Category;

use Mercadona\Domain\Category\Category;
use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Domain\Category\CategoryId;
use Mercadona\Domain\Category\CategoryName;
use Mercadona\Domain\Product\ProductCollection;
use Mercadona\Infrastructure\Domain\Product\ProductDataTransformer;

final class CategoryDataTransformer
{
    public static function fromArray(array $result, ?array $parent): Category
    {
        return new Category(
            new CategoryId($result["id"]),
            $parent ? new CategoryId($parent["id"]) : null,
            new CategoryName($result["name"]),
            $result["published"],
            $result["order"],
            isset($result["categories"]) ? self::fromArrays($result["categories"], $result) : CategoryCollection::empty(),
            isset($result["products"]) ? ProductDataTransformer::fromArrays($result["products"]) : ProductCollection::empty(),
        );
    }

    public static function fromArrays(array $categoriesArray, ?array $parent): CategoryCollection
    {
        $categories = [];
        foreach ($categoriesArray as $categoryArray) {
            $categories[] = self::fromArray($categoryArray, $parent);
        }

        return new CategoryCollection($categories);
    }

    public static function fromEntity(Category $category)
    {
       return [
           "id" => $category->id()->value(),
           "category_id" => $category->parentId()?->value(),
            "is_parent" => (int) !$category->categories()->isEmpty(),
            "name" => $category->name()->value(),
            "published" => $category->published(),
            "order" => $category->order()
        ];
    }
}
