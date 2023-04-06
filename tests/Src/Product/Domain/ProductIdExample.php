<?php declare(strict_types=1);

namespace Tests\Mercadona\Product\Domain;

use Mercadona\Product\Domain\ProductId;
use Tests\Mercadona\Shared\Domain\IntegerExample;

final class ProductIdExample {

    public static function random(): ProductId
    {
        return new ProductId(IntegerExample::random());
    }
}