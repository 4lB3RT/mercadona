<?php declare(strict_types=1);

namespace Tests\Mercadona\Domain\Category;

use Mercadona\Domain\Product\ProductName;
use Tests\Mercadona\Shared\Domain\StringExample;

final class ProductNameExample {

    public static function random(): ProductName
    {
        return new ProductName(StringExample::random());
    }
}