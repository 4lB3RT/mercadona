<?php declare(strict_types=1);

namespace Tests\Mercadona\Category\Domain\ValueObject;

use Tests\Mercadona\Shared\Domain\StringExample;
use Mercadona\Category\Domain\ValueObject\CategoryName;

final class CategoryNameExample {

    public static function random(): CategoryName
    {
        return new CategoryName(StringExample::random());
    }
}