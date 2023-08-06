<?php declare(strict_types=1);

namespace Tests\Mercadona\Product\Domain;

use Mercadona\Product\Domain\ValueObject\ProductName;
use Tests\Mercadona\Shared\Domain\StringExample;

final class ProductNameExample {

    public static function random(): ProductName
    {
        return new ProductName(StringExample::random());
    }
}