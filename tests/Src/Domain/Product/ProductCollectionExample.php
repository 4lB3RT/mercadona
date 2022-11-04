<?php declare(strict_types=1);

namespace Tests\Mercadona\Domain\Product;

use Mercadona\Domain\Product\ProductCollection;

final class ProductCollectionExample {

    public static function dummy(): ProductCollection
    {
        return new ProductCollection([ProductExmaple::dummy()]);
    }

    public static function random(): ProductCollection
    {
        return new ProductCollection([ProductExmaple::random()]);
    }

    public static function empty(): ProductCollection
    {
        return new ProductCollection([]);
    }
}