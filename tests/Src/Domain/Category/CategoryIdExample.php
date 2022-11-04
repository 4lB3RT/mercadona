<?php declare(strict_types=1);

namespace Tests\Mercadona\Domain\Category;

use Mercadona\Domain\Category\CategoryId;
use Tests\Mercadona\Shared\Domain\IntegerExample;

final class CategoryIdExample {

    public static function random(): CategoryId
    {
        return new CategoryId(IntegerExample::random());
    }
}