<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Product;

use Mercadona\Domain\Category\Category;
use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Domain\Product\ProductCollection;
use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductId;
use Mercadona\Domain\Product\ProductName;

final class ProductDataTransformer
{
    public static function fromArray(array $result, CategoryCollection $categories): Product
    {
        return new Product(
            new ProductId($result["id"]),
            $categories,
            new ProductName($result["display_name"]),
            isset($result["slug"]) ? $result["slug"] : null,
            $result["limit"],
            isset($result["published"]) ? $result["published"] : null,
            isset($result["shared_url"]) ? $result["shared_url"] : null,
            $result["thumbnail"],
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

    public static function fromEntity(Product $product)
    {
       return [
            "id" => $product->id->value,
            "name" => $product->name->value,
            "slug" => $product->slug,
            "limit" => $product->limit,
            "published" => $product->published,
            "share_url" => $product->shareUrl,
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
