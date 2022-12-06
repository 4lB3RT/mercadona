<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Product;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Domain\Product\ProductCollection;
use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductId;
use Mercadona\Domain\Product\ProductName;
use Mercadona\Infrastructure\Domain\Category\CategoryDataTransformer;
use Mercadona\Infrastructure\Domain\Price\PriceDataTransformer;

final class ProductDataTransformer
{
    public static function fromArray(array $result, CategoryCollection $categories): Product
    {
        return new Product(
            new ProductId((int) $result["id"]),
            new ProductName($result["display_name"]),
            (int) $result["ean"],
            isset($result["slug"]) ? $result["slug"] : null,
            $result["brand"],
            $result["limit"],
            $result["origin"],
            $result["packaging"],
            isset($result["published"]) ? (bool) $result["published"] : null,
            isset($result["share_url"]) ? $result["share_url"] : null,
            $result["thumbnail"],
            isset($result["isVariableWeight"]) ? $result["isVariableWeight"] : null,
            $categories,
            isset($result["price_instructions"]) ? PriceDataTransformer::fromArrays($result["price_instructions"]) : null
        );
    }

    public static function fromArrays(array $productsArray, CategoryCollection $categories): ProductCollection
    {
        $products = [];
        foreach ($productsArray as $productArray) {
            $products[] = self::fromArray($productArray, $categories);
        }

        return new ProductCollection($products);
    }

    public static function fromEntity(Product $product): array
    {
       return [
            "id" => $product->id->value,
            "name" => $product->name->value,
            "ean" => $product->ean,
            "slug" => $product->slug,
            "brand" => $product->brand,
            "limit" => $product->limit,
            "origin" => $product->origin,
            "packaging" => $product->packaging,
            "published" => $product->published,
            "share_url" => $product->shareUrl,
            "thumbnail" => $product->thumbnail,
            "is_variable_weight" => $product->isVariableWeight,
            "categories" => CategoryDataTransformer::fromEntities($product->categories()),
            "prices" => PriceDataTransformer::fromEntities($product->prices()),
        ];
    }

    public static function fromEntities(ProductCollection $products)
    {
        $productsArray = [];

        /** @var Product $product */
        foreach ($products as $product) {
            $productsArray[] = self::fromEntity($product);
        }

        return $productsArray;
    }

    public static function fromCollection(Collection $collection): ProductCollection
    {
        $products = [];
        /** @var Model $model */
        foreach ($collection as $model) {
            $products[] = self::fromModel($model);
        }

        return new ProductCollection($products);
    }

    public static function fromModel(Model $model): Product
    {
        return new Product(
            new ProductId($model->id),
            new ProductName($model->name),
            $model->ean,
            $model->slug,
            $model->brand,
            $model->limit,
            $model->origin,
            $model->packaging,
            (bool)$model->published,
            $model->share_url,
            $model->thumbnail,
            $model->isVariableWeight,
            CategoryDataTransformer::fromCollection($model->categories),
            ($model->prices !== null) ? PriceDataTransformer::fromCollection($model->prices) : null,
            
        );
    }

}
