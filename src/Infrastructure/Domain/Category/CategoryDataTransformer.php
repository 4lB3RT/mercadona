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
        return new Category(
            new CategoryId($result["id"]),
            $parent ? new CategoryId($parent["id"]) : null,
            new CategoryName($result["name"]),
            isset($result["categories"]) ? CategoryStatus::PROCESSED : CategoryStatus::READY,
            isset($result["published"]) ? $result["published"] : null,
            isset($result["order"]) ? $result["order"] : null,
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
            "status" => $category->status()->name,
            "published" => $category->published(),
            "order" => $category->order()
        ];
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
            $model->category_id ? new CategoryId($model->category_id) : null,
            new CategoryName($model->name),
            CategoryStatus::READY,
            (bool) $model->published,
            $model->order,
            !empty($model->categories) ? self::fromCollection($model->categories) : CategoryCollection::empty(),
            ProductCollection::empty()
        );
    }

}
