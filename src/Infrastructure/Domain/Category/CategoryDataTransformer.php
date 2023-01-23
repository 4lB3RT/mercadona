<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Category;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Mercadona\Domain\Category\Category;
use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Domain\Category\CategoryId;
use Mercadona\Domain\Category\CategoryName;
use Mercadona\Domain\Category\CategoryStatus;
use Mercadona\Domain\Product\ProductCollection;
use Mercadona\Infrastructure\Domain\Product\ProductDataTransformer;

final class CategoryDataTransformer
{
    public static function fromArray(array $result, ?array $parent): Category
    {
        $category = new Category(
            new CategoryId($result["id"]),
            new CategoryName($result["name"]),
            isset($result["categories"]) ? CategoryStatus::PROCESSED : CategoryStatus::READY,
            isset($result["categories"]) ? self::fromArrays($result["categories"], $result) : CategoryCollection::empty(),
            null,
            $parent ? new CategoryId($parent["id"]) : null,
            isset($result["order"]) ? $result["order"] : null,
            isset($result["published"]) ? $result["published"] : null,
        );
        
        $products = isset($result["products"]) ? ProductDataTransformer::fromArrays($result["products"], new CategoryCollection([$category])) : ProductCollection::empty();
        
        $category->modifyProducts($products);
        
        return $category;
    }

    public static function fromArrays(array $categoriesArray, ?array $parent): CategoryCollection
    {
        $categories = [];
        foreach ($categoriesArray as $categoryArray) {
            $categories[] = self::fromArray($categoryArray, $parent);
        }

        return new CategoryCollection($categories);
    }

    public static function fromEntity(Category $category): array
    {
       return [
            "id" => $category->id()->value(),
            "category_id" => $category->parentId()?->value(),
            "name" => $category->name()->value(),
            "status" => $category->status()->name,
            "categories" => $category->categories()->isEmpty() ? CategoryCollection::empty() : self::fromEntities($category->categories()),
            "products" => $category->products()->isEmpty() ? ProductCollection::empty() : ProductDataTransformer::fromEntities($category->products()),
            "is_parent" => (int) !$category->categories()->isEmpty(),
            "order" => $category->order(),
            "published" => $category->published(9),
        ];
    }

    public static function fromEntities(CategoryCollection $categories)
    {
        $categoriesArray = [];

        /** @var Category $category */
        foreach ($categories as $category) {
            $categoriesArray[] = self::fromEntity($category);
        }

        return $categoriesArray;
    }

    public static function fromCollection(Collection $collection): CategoryCollection
    {
        $categories = [];
        /** @var Model $model */
        foreach ($collection as $model) {
            $categories[] = self::fromModel($model);
        }

        return new CategoryCollection($categories);
    }

    public static function fromModel(Model $model): Category
    {
        return new Category(
            new CategoryId($model->id),
            new CategoryName($model->name),
            CategoryStatus::READY,
            !empty($model->categories) ? self::fromCollection($model->categories) : CategoryCollection::empty(),
            !empty($model->products) ? ProductDataTransformer::fromCollection($model->products) : ProductCollection::empty(),
            $model->category_id ? new CategoryId($model->category_id) : null,
            $model->order,
            (bool) $model->published,
        );
    }

}
