<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Product;

use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Domain\Product\ProductCollection;
use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductId;
use Mercadona\Domain\Product\ProductName;
use Mercadona\Infrastructure\Domain\Category\CategoryDataTransformer;

final class ProductDataTransformer
{
    public static function fromArray(array $result): Product
    {
        return new Product(
            new ProductId($result["id"]),
            isset($result["categories"]) ? CategoryDataTransformer::fromArrays($result["categories"], null) : CategoryCollection::empty(),
            new ProductName($result["display_name"]),
            isset($result["slug"]) ? $result["slug"] : null,
            $result["limit"],
            isset($result["published"]) ? $result["published"] : null,
            isset($result["shared_url"]) ? $result["shared_url"] : null,
            $result["thumbnail"],
        );
    }

    public static function fromArrays(array $productsArray): ProductCollection
    {
        $products = [];
        foreach ($productsArray as $productArray) {
            $products[] = self::fromArray($productArray);
        }

        return new ProductCollection($products);
    }
}
