<?php declare(strict_types=1);

namespace Tests\Mercadona\Domain\Category;

use Mercadona\Domain\Product\ProductId;
use Tests\Mercadona\Shared\Domain\IntegerExample;

final class ProductIdExample {

    public static function random(): ProductId
    {
        return new ProductId(IntegerExample::random());
    }
}