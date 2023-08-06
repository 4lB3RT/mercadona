<?php declare(strict_types=1);

namespace Mercadona\Category\Infrastructure\Transformers;

use Illuminate\Database\Eloquent\Model;
use Mercadona\Category\Domain\Category;
use Mercadona\Category\Domain\CategoryId;
use Mercadona\Category\Domain\CategoryName;
use Illuminate\Database\Eloquent\Collection;
use Mercadona\Category\Domain\CategoryStatus;
use Mercadona\Product\Domain\ProductCollection;
use Mercadona\Category\Domain\CategoryCollection;
use Mercadona\Category\Domain\CategoryOrder;
use Mercadona\Category\Domain\CategoryPublished;
use Mercadona\Product\Infrastructure\Transformers\ProductDataTransformer;

final class CategoryDataTransformer
{
    public static function fromArray(array $result, ?array $parent = null): Category
    {        
        $category = new Category(
            new CategoryId($result["id"]),
            new CategoryName($result["name"]),
            isset($result["categories"]) ? CategoryStatus::PROCESSED : CategoryStatus::READY,
            isset($result["categories"]) ? self::fromArrays($result["categories"], $parent) : CategoryCollection::empty(),
            ProductCollection::empty(),
            $parent ? new CategoryId($parent["id"]) : null,
            isset($result["order"]) ? new CategoryOrder($result["order"]) : null,
            isset($result["published"]) ? new CategoryPublished($result["published"]) : null,
        );
            
        $products = isset($result["products"]) ? ProductDataTransformer::fromArrays($result["products"], $category) : ProductCollection::empty();
        
        $category->modifyProducts($products);
        
        return $category;
    }

    public static function fromArrays(array $categoriesArray, ?array $parent = null): CategoryCollection
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
        $categories = CategoryCollection::empty();
        if ($model->relationLoaded('allChildrenCategories')) {
            $categories = self::fromCollection($model->allChildrenCategories);
        }

        $products = ProductCollection::empty();
        if ($model->relationLoaded('products')) {
            $products = ProductDataTransformer::fromCollection($model->products);
        }

        return new Category(
            new CategoryId($model->id),
            new CategoryName($model->name),
            CategoryStatus::READY,
            $categories,
            $products,
            $model->category_id ? new CategoryId($model->category_id) : null,
            $model->order ? new CategoryOrder($model->order) : null,
            $model->published ? new CategoryPublished((bool) $model->published) : null,
        );
    }

}
