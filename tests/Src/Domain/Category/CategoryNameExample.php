<?php declare(strict_types=1);

namespace Tests\Mercadona\Domain\Category;

use Mercadona\Domain\Category\CategoryName;
use Tests\Mercadona\Shared\Domain\StringExample;

final class CategoryNameExample {

    public static function random(): CategoryName
    {
        return new CategoryName(StringExample::random());
    }
}