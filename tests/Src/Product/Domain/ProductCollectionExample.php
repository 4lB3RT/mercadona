<?php declare(strict_types=1);

namespace Tests\Mercadona\Product\Domain;

use Mercadona\Product\Domain\ProductCollection;

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