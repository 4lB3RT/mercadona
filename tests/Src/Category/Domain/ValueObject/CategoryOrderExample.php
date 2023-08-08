<?php declare(strict_types=1);

namespace Tests\Mercadona\Category\Domain\ValueObject;

use Tests\Mercadona\Shared\Domain\IntegerExample;
use Mercadona\Category\Domain\ValueObject\CategoryOrder;

final class CategoryOrderExample {

    public static function dummy(): CategoryOrder
    {
        return new CategoryOrder(1);
    }

    public static function create(
        ?CategoryOrder $categoryOrder = null
    ): CategoryOrder {
        return $categoryOrder ?? self::random();
    }

    public static function random(): CategoryOrder
    {
        return new CategoryOrder(IntegerExample::random());
    }
}