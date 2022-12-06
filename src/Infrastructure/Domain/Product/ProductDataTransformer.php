<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Product;

use Mercadona\Domain\Category\Category;
use Mercadona\Domain\Product\ProductCollection;
use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductId;
use Mercadona\Domain\Product\ProductName;
use Mercadona\Infrastructure\Domain\Category\CategoryDataTransformer;

final class ProductDataTransformer
{
    public static function fromArray(array $result, Category $category): Product
    {
        return new Product(
            new ProductId($result["id"]),
            $category,
            new ProductName($result["display_name"]),
            isset($result["slug"]) ? $result["slug"] : null,
            $result["limit"],
            isset($result["published"]) ? $result["published"] : null,
            isset($result["shared_url"]) ? $result["shared_url"] : null,
            $result["thumbnail"],
        );
    }

    public static function fromArrays(array $productsArray, Category $category): ProductCollection
    {
        $products = [];
        foreach ($productsArray as $productArray) {
            $products[] = self::fromArray($productArray, $category);
        }

        return new ProductCollection($products);
    }

    public static function fromEntity(Product $product)
    {
       return [
            "id" => $product->id->value,
            "name" => $product->name->value,
            "slug" => $product->slug,
            "limit" => $product->limit,
            "published" => $product->published,
            "shareUrl" => $product->shareUrl,
            "thumbnail" =>  $product->thumbnail
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

}
